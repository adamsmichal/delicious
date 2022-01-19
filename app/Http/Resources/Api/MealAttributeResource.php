<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MealAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'price' => $this->price,
            'size' => $this->size,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
