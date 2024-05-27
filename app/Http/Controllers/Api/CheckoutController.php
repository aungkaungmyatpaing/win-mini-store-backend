<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Http\Resources\CartResource;
use App\Services\API\CheckoutService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use ApiResponse;

    private CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkoutPreview()
    {
        $previewData = $this->checkoutService->getCheckoutPreview();

        $preview = [
            'carts' => CartResource::collection($previewData['carts']),
            'total' => $previewData['total'],
            'total_point' => $previewData['total_point']
        ];
        return $this->success('Get checkout preview successfully', $preview);
    }

    public function checkout(CheckoutRequest $request)
    {
        $checkout = $this->checkoutService->checkout($request->validated());
        return $this->success('Checkout successfully', new ($checkout));
    }
}
