<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class AuthController extends Controller
{

    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if(!$token){
            return ApiFormatter::formatter(400, 'Unauthorized', );
        }
        return ApiFormatter::formatter(200, 'Authorized', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout() {
        auth()->logout();
        return ApiFormatter::formatter(200, 'Logout Success');
    }

    public function refresh() {
        return ApiFormatter::formatter(200, 'Token has been Refreshed', [
            'access_token' => $auth->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function data() {
        return ApiFormatter::formatter(200,  'Success get Data', auth()->user());
    }

}
