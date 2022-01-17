<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_uuid' => ['required', 'uuid'],
            'currency' => ['required', 'size:3'],
            'meals_ids' => ['required'],
//            'payment_method_id' => ['required', 'exists:payment_methods_id']
            'payment_method_id' => ['required']
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        $errors = (new ValidationException($validator))->errors();
//        throw new HttpResponseException(response()->json([
//            'error' => true,
//            'message' => $errors
//        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
//    }
}