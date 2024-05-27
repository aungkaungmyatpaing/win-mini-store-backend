<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddToCartRequest;
use App\Http\Requests\Api\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\API\CartService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponse;

    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(AddToCartRequest $requestArray)
    {
        $this->cartService->addToCart($requestArray->validated());
        return $this->success('Added to cart successfully');
    }

    public function getCarts()
    {
        $carts = $this->cartService->getCarts();
        return $this->success('Get carts successfully', CartResource::collection($carts));
    }

    public function updateCart(UpdateCartRequest $requestArray,int $id)
    {
        $this->cartService->updateCart($requestArray->validated(),$id);
        return $this->success('Cart updated successfully');
    }

    public function deleteCart(int $id)
    {
        $this->cartService->deleteCart($id);
        return $this->success('Cart deleted successfully');
    }
}
