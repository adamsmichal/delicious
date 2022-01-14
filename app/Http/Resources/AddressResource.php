<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class AddressResource extends JsonResource
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
            'city' => $this->city,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'flat_number' => $this->flat_number,
            'post_code' => $this->post_code,
            'country' => $this->country,
            'country_iso' => $this->country_iso,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
