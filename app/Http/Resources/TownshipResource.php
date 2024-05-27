<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TownshipResource extends JsonResource
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
            'name' => $this->name,
            'name_mm' => $this->name_mm,
            'delivery_fee' => $this->delivery_fee,
            'duration' => $this->duration,
            'remark' => $this->remark,
            'cod' => $this->cod == 1 ? true : false,
            'region' => new RegionResource($this->region),
        ];
    }
}
