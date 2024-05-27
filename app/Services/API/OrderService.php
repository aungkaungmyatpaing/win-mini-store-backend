<?php

namespace App\Services\API;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getOrderHistories()
    {
        $user = Auth::guard('customer')->user();
        $orders = $user->orderDetail;

        return $orders;
    }

    public function getOrderDetail($id): OrderDetail
    {
        $user = Auth::guard('customer')->user();
        $order = $user->orderDetail()->findOrFail($id);

        return $order;
    }
}
