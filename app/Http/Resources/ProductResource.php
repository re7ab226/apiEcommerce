<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'is_trendy' => $this->is_trendy,
            'is_available' => $this->is_available,
            'price' => $this->price,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
