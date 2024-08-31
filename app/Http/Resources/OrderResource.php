<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
                'date_of_delivery' => $this->date_of_delivery,
                'user_id' => $this->user_id,
                'location_id' => $this->location_id,
                'total_price' => $this->total_price,
                'status'=>$this->status,
            ];
        }    
}
