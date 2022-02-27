<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json(['user' => $user, 'message' => 'User acccount updated']);
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(Hash::check($request->current_password, $user->password)) {
            $user->update([ 'password' => Hash::make($request->password) ]);
            return response()->json(['message' => 'Password updated']);
        } else {
            return response()->json(['message' => 'Invalid user password']);
        }
    }

    public function commissionRequests(Request $request)
    {
        $commissionRequests = $request->user()->requests()
                                              ->orderBy('created_at', 'DESC')
                                              ->with('offers.images')
                                              ->with('offers.user')
                                              ->with('user')
                                              ->with('images')
                                              ->paginate(20);
        return response()->json(['requests' => $commissionRequests]);
    }

    public function offers(Request $request)
    {
        $offers = $request->user()->offers()
                                  ->with('images')
                                  ->with('user')
                                  ->with('request.images')
                                  ->with('request.user')
                                  ->orderBy('created_at', 'DESC')
                                  ->paginate(10);
        return response()->json(['offers' => $offers]);
    }
}
