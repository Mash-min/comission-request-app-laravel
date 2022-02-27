<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestValidation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.unique' => 'Username not available',
            'email.required' => 'Email is required',
            'email.unique' => 'Email not available',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation not matched'
        ];
    }
}
