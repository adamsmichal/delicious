<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'house_number' => ['required', 'string'],
            'flat_number' => ['required', 'string'],
            'post_code' => ['required', 'string'],
            'country' => ['required', 'string'],
            'country_iso' => ['required', 'string']
        ];
    }
}
