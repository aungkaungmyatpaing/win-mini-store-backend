<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->address,
            'name' => $this->name,
            'phone' => $this->phone,
            'address_type' => $this->address_type ? $this->address_type : null,
            'township' => new TownshipResource($this->township)
        ];
    }
}
