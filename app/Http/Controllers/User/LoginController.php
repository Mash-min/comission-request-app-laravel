<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Invalid user credentials'], 401);
        } else {
            $user = auth()->user();
            $user->tokens()->delete();
            $token = $user->createToken('user_token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
