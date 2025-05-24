<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(ApiLoginRequest $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid Credentials', 401);
        };

        $user = User::firstWhere('email', $request->email);

        return $this->ok('Successfully Logged In', [
            'token' => $user->createToken('API token for ' . $user->email)->plainTextToken
        ]);
    }
}
