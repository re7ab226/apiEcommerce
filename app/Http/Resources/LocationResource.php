<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    
        public function toArray($request)
        {
            return [
                'user_id' => $this->user_id,
                'street' => $this->street,
                'building' => $this->building,
                'area' => $this->area,
               
            ];
        }

    
}
