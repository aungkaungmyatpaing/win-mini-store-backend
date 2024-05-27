<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'product_id' => $this->product_id,
            'name' => $this->product->name,
            'category' => $this->product->category->english_name,
            'brand' => $this->product->brand->name,
            'color' => $this->color ? $this->color->english_name : null,
            'size' => $this->size ? $this->size->english_name : null,
            'redeem' => $this->redeem == 1 ? true : false,
            'quantity' => $this->quantity
        ];
    }
}
