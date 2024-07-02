<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends BaseApiController
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $auth = app(JWTAuth::class);

            if (!$token = $auth->attempt($credentials)) {
                return $this->respondUnauthorized();
            }

            $response = array_merge(['token' => $token], $auth->user()->getJWTCustomClaims());

            return $this->respondSuccess($response);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return $this->respondInternalServerError($e->getMessage());
        }
    }

    public function logout()
    {
        return $this->respondSuccess();
    }
}
