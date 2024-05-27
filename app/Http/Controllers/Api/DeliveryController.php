<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentAccountResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\RegionResource;
use App\Http\Resources\TownshipResource;
use App\Services\API\DeliveryService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    use ApiResponse;

    private DeliveryService $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function getRegions()
    {
        $regions = $this->deliveryService->getRegions();
        return $this->success("Get regions successful", RegionResource::collection($regions));
    }

    public function getTownships($id)
    {
        $townships = $this->deliveryService->getTownships($id);
        return $this->success("Get townships successful", TownshipResource::collection($townships));
    }

    public function getPayments()
    {
        $payments = $this->deliveryService->getPayments();
        return $this->success("Get payments successful", PaymentResource::collection($payments));
    }

    public function getPaymentAccounts($id)
    {
        $payment_accounts = $this->deliveryService->getPaymentAccounts($id);
        return $this->success("Get payments successful", PaymentAccountResource::collection($payment_accounts));
    }
}
