<?php

namespace App\Services\API;

use App\Exceptions\CreateDataFailException;
use App\Exceptions\UnprocessableRequestException;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CheckoutService
{
    protected $path = 'storage/images/slips/';

    public function getCheckoutPreview(): array
    {
        $user = Auth::guard('customer')->user();
        $carts = $user->carts;

        $total = 0;

        $total_point = 0;
        foreach ($carts as $cart) {
            $product = $cart->product;
            if($cart->redeem == false){
                $price = $product->price;

                // Check if the product has WholeSaleProducts and if the cart quantity
                // is greater than or equal to the WholeSaleProduct quantity
                if ($product->wholeSaleProducts->isNotEmpty()) {
                    $matchingWholeSaleProduct = null;

                    foreach ($product->wholeSaleProducts as $wholeSaleProduct) {
                        if ($cart->quantity >= $wholeSaleProduct->quantity) {
                            if (!$matchingWholeSaleProduct || $wholeSaleProduct->quantity > $matchingWholeSaleProduct->quantity) {
                                $matchingWholeSaleProduct = $wholeSaleProduct;
                            }
                        }
                    }

                    if ($matchingWholeSaleProduct) {
                        $price = $matchingWholeSaleProduct->price;
                    }
                }

                // Update the total based on the adjusted price
                $total += $price * $cart->quantity;
            }else{
                $total_point += $product->point * $cart->quantity;
            }

        }

        $data = [
            'carts' => $carts,
            'total' => $total,
            'total_point' => $total_point
        ];

        return $data;
    }

    public function checkout(array $requestData)
    {
        if (!$requestData['cod']) {
            if (!array_key_exists('payment_account_id', $requestData) || !array_key_exists('slip', $requestData)) {
                throw new ValidationException('Payment informations are required');
            }
        }

        $user = Auth::guard('customer')->user();
        $carts = $user->carts;

        $deli_fee = $user->address->find($requestData['address_id'])->township->delivery_fee;

        $exchange_rate = Currency::first();


        if ($carts->isEmpty()) {
            throw new UnprocessableRequestException('Checkout failed, cart is empty');
        }

        $total = 0;
        $total_point = 0;

        DB::beginTransaction();
        try {
            foreach ($carts as $cart) {
                $product = $cart->product;
                if ($cart->redeem == false) {

                    $price = $product->price;

                    if ($product->wholeSaleProducts->isNotEmpty()) {
                        $matchingWholeSaleProduct = null;

                        foreach ($product->wholeSaleProducts as $wholeSaleProduct) {
                            if ($cart->quantity >= $wholeSaleProduct->quantity) {
                                if (!$matchingWholeSaleProduct || $wholeSaleProduct->quantity > $matchingWholeSaleProduct->quantity) {
                                    $matchingWholeSaleProduct = $wholeSaleProduct;
                                }
                            }
                        }

                        if ($matchingWholeSaleProduct) {
                            $price = $matchingWholeSaleProduct->price;
                        }
                    }

                    // Update the total based on the adjusted price
                    $total += $price * $cart->quantity;
                }else{
                    $total_point += $product->point * $cart->quantity;
                }
            }

            $grandTotal = $total + $deli_fee;

            $grandTotalExchange = $grandTotal * $exchange_rate->baht;


            $order = $user->orderDetail()->create([
                'address_id' => $requestData['address_id'],
                'cod' => $requestData['cod'],
                'payment_account_id' => $requestData['cod'] ? null : $requestData['payment_account_id'],
                'total' => $total,
                'grand_total' => $grandTotal,
                'note' => $requestData['note'] ?? '',
                'order_time_exchange_rate' => $exchange_rate ? $exchange_rate->baht : 0,
                'grand_total_exchange' => $grandTotalExchange,
                'total_point' => $total_point
            ]);

            if ($user->point >= $total_point) {
                $user->point -= $total_point;
                $user->save();
            }else{
                DB::rollBack();
                throw new CreateDataFailException('Checkout failed, not enought point for redeem item');
            }

            if (array_key_exists('slip', $requestData) && !$requestData['cod']) {
                $slip = $requestData['slip'];
                try {
                    $slipname = $this->generateUniqueFilename($slip);
                    $slip->move(public_path($this->path), $slipname);
                    $order->slip = $slipname;
                    $order->save();
                } catch (\Exception $e) {
                    throw new CreateDataFailException('Checkout failed, slip upload failed');
                }
            }

            foreach ($carts as $cart) {
                $product = $cart->product;
                $price = $product->price;
                if ($product->wholeSaleProducts->isNotEmpty()) {
                    $matchingWholeSaleProduct = null;

                    foreach ($product->wholeSaleProducts as $wholeSaleProduct) {
                        if ($cart->quantity >= $wholeSaleProduct->quantity) {
                            if (!$matchingWholeSaleProduct || $wholeSaleProduct->quantity > $matchingWholeSaleProduct->quantity) {
                                $matchingWholeSaleProduct = $wholeSaleProduct;
                            }
                        }
                    }

                    if ($matchingWholeSaleProduct) {
                        $price = $matchingWholeSaleProduct->price;
                    }
                }

                // Update the total price based on the adjusted price and quantity
                $totalPrice = $price * $cart->quantity;

                // Create the order list item
                $order->orderLists()->create([
                    'customer_id' => $user->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'color_id' => $cart->color_id ?? null,
                    'size_id' => $cart->size_id ?? null,
                    'redeem' => $cart->redeem,
                    'price' => $price,
                    'total_price' => $cart->redeem == true ? 0 : $totalPrice
                ]);
            }

            $user->carts()->delete();

            DB::commit();
            return $order;
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            throw new CreateDataFailException('Checkout failed : ' . $th->getMessage());
        }
    }

    public static function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = 'slips/'.uniqid('slip_') . '.' . $extension;

        while (Storage::disk('public')->exists('slips/' . $filename)) {
            $filename = uniqid('slip_') . '.' . $extension;
        }

        return $filename;
    }

}
