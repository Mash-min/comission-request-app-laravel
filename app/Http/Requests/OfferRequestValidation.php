<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequestValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required',
            'price' => 'required|numeric'
        ];
    }

    public function message()
    {
        return [
            'description.required' => 'Offer description is required',
            'price.required' => 'Offer price is required',
            'price.numeric' => 'Invalid offer price'
        ];
    }
}
