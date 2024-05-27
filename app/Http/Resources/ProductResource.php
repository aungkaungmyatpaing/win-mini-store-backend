<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imagePath = $this->image ? $this->image->path : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->english_name,
            'brand' => $this->brand->name,
            'image' => $imagePath,
            'description' => $this->description,
            'price' => $this->price,
            'instock' => $this->instock,
        ];
    }
}
