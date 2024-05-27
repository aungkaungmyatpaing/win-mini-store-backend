<?php

namespace App\Services\API;

use App\Exceptions\CreateDataFailException;
use App\Exceptions\UnprocessableRequestException;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function addToCart(array $request)
    {
        // dd($request['redeem']);
        $customer = Auth::guard('customer')->user();
        $product = Product::findOrFail($request['product_id']);

        $productStock = $product->instock_amount;
        $productPoint = $product->point;
        if (array_key_exists('color_id', $request) || array_key_exists('size_id', $request)) {
            $oldCart = $customer->carts()
            ->where('product_id', $request['product_id'])
            ->where('redeem', $request['redeem'])
            ->firstWhere(function ($query) use ($request) {
                if (array_key_exists('color_id', $request) && array_key_exists('size_id', $request)) {
                    $query->where('color_id', $request['color_id'])
                        ->where('size_id', $request['size_id']);
                    return true;
                }

                if (array_key_exists('color_id', $request)) {
                    $query->where('color_id', $request['color_id'])
                        ->whereNull('size_id');
                    return true;
                }

                if (array_key_exists('size_id', $request)) {
                    $query->whereNull('color_id')
                        ->where('size_id', $request['size_id']);
                    return true;
                }

                return true;
            });
        }else{
            $oldCart = $customer->carts()
            ->where('product_id', $request['product_id'])
            ->where('redeem',$request['redeem'])
            ->whereNull('size_id')
            ->whereNull('color_id')->first();
        }

        // dd($oldCart);


        if ($oldCart) {
            if ($oldCart->quantity + $request['quantity'] > $productStock) {
                throw new CreateDataFailException('Product is out of stock');
            }
            try {
                $oldCart->quantity += $request['quantity'];
                $oldCart->redeem = $request['redeem'];
                $oldCart->save();
            } catch (\Throwable $th) {
                throw new CreateDataFailException('Failed to add to cart');
            }
        } else {
            if ($request['quantity'] > $productStock) {
                throw new CreateDataFailException('product is out of stock');
            }
            try {
                $cartData = [
                    'product_id' => $request['product_id'],
                    'quantity' => $request['quantity'],
                    'redeem' => $request['redeem']
                ];

                if (array_key_exists('color_id', $request)) {
                    $colorExists = $product->productColors()->where('colors.id', $request['color_id'])->exists();
                    if ($colorExists) {
                        $cartData['color_id'] = $request['color_id'];
                    }else{
                        throw new UnprocessableRequestException('Selected color is not available for the product.');
                    }
                }
                if (array_key_exists('size_id', $request)) {
                    $sizeExists = $product->productSizes()->where('sizes.id', $request['size_id'])->exists();
                    if ($sizeExists) {
                        $cartData['size_id'] = $request['size_id'];
                    }else{
                        throw new UnprocessableRequestException('Selected size is not available for the product.');
                    }
                }


                $customer->carts()->create($cartData);
            } catch (\Throwable $th) {
                dd($th);
                throw new CreateDataFailException('Failed to add to cart');
            }
        }
    }

    public function getCarts()
    {
        $customer = Auth::guard('customer')->user();
        return $customer->carts;
    }

    public function updateCart(array $request, int $id)
    {
        $customer = Auth::guard('customer')->user();
        $cart = $customer->carts()->findOrFail($id);
        $productStock = $cart->product->instock_amount;

        if ($request['quantity'] > $productStock) {
            throw new CreateDataFailException('Product is out of stock');
        }

        try {
            $cart->quantity = $request['quantity'];
            $cart->redeem = $request['redeem'];
            $cart->save();
        } catch (\Throwable $th) {
            throw new CreateDataFailException('Failed to update cart');
        }
    }

    public function deleteCart(int $id)
    {
         $customer = Auth::guard('customer')->user();
         $cart = $customer->carts()->findOrFail($id);
         try {
             $cart->delete();
         } catch (\Throwable $th) {
             throw new CreateDataFailException('Failed to delete cart');
         }
    }
}
