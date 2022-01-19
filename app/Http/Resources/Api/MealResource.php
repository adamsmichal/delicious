<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MealResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'photo' => $this->photo,
            'description' => $this->description,
            'preparation_time' => $this->preparation_time,
            'is_active' => $this->is_active,
            'attributes' => MealAttributeResource::collection($this->mealAttributes),
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
