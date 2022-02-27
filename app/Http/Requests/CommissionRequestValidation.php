<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequestValidation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'images' => 'min:1|numeric'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Request title is required',
            'description.required' => 'Request description is required',
            'price.required' => 'Request price is required',
            'price.numeric' => 'The given price is invalid',
            'images.min' => 'Please attach some images'
        ];
    }
}
