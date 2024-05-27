<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cod' => $this->cod == 1 ? true : false,
            'slip' => $this->cod == 0 && $this->slip ? $this->slip : null,
            'total' => $this->total,
            'grand_total' => $this->grand_total,
            'order_time_exchange_rate' => $this->order_time_exchange_rate,
            'grand_total_exchange' => $this->grand_total_exchange,
            'status' => $this->status,
            'note' => $this->note,
            'address' => new AddressResource($this->address),
            'payment' => new PaymentAccountResource($this->paymentAccount),
            'items' => OrderListResource::collection($this->orderLists),
        ];
    }
}
