<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'photo' => ['required', 'string'],
            'description' => ['required', 'string'],
            'preparation_time' => ['required', 'integer'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
