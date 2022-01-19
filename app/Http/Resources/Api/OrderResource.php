<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\OrderPaymentStatusEnum;
use Illuminate\Http\Request;

class OrderResource extends JsonResource
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
            'user_id' => UserResource::make($this->user),
            'address_id' => $this->address_id,
            'notes' => $this->notes,
            'payment_status' => $this->payment_status,
            'payment_date' => $this->payment_status,
//            'products_price' =>
//            'shipment_price' =>
//            'total_price' =>
            'currency' => $this->currency,
            'transaction_number' => $this->transaction_number,
//            'payment_method_id' =>
//            'discount_id' =>
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
