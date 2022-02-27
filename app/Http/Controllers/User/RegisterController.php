<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequestValidation;

class RegisterController extends Controller
{
    public function create(UserRequestValidation $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::create($request->except('password') + [
            'password' => Hash::make($request->password)
        ]);
        
        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }
}
