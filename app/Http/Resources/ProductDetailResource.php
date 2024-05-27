<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imagePaths = $this->images->isNotEmpty() ? $this->images->pluck('path')->toArray() : [];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->instock_amount,
            'point' => $this->point,
            'instock' => $this->instock == '1' ? true : false,
            'redeemable' => $this->redeemable == '1' ? true : false,
            'image' => $imagePaths,
            'category' => new CategoryResource($this->category),
            'brand' => new BrandResource($this->brand),
            'color' => ColorResource::collection($this->productColors),
            'size' => SizeResource::collection($this->productSizes),
            'wholeSale' => WholeSaleProductResource::collection($this->wholeSaleProducts),
        ];
    }
}
