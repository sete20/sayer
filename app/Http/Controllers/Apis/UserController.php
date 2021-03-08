<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\EmployeeIndividualProfile;
use App\Models\User;
use App\Models\UserCommission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->only('phone','password');

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    public function profile()
    {
        return response()->json(auth('api')->user()->profile);
    }

    public function representativeCommission()
    {
        $commission = UserCommission::query()->where('user_id',auth('api')->user()->id)->get();

        return response()->json($commission);
    }
}
