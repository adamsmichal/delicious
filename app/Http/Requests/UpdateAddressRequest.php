<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => ['string'],
            'street' => ['string'],
            'house_number' => ['string'],
            'flat_number' => ['string'],
            'post_code' => ['string'],
            'country' => ['string'],
            'country_iso' => ['string']
        ];
    }
}
