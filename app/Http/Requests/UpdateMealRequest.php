<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMealRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string'],
            'photo' => ['string'],
            'description' => ['string'],
            'preparation_time' => ['integer'],
            'is_active' => ['boolean']
        ];
    }
}
