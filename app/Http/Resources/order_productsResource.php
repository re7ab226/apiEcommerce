<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class order_productsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
        public function toArray($request)
        {
            return [
                'id' => $this->id,
                'order_id' => $this->order_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
            ];
        }    
}
