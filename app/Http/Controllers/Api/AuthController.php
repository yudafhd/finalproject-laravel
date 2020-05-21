<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $fieldLogin = 'email';

    public function login(Request $request)
    {
        $this->conditionalLogin($request);

        try {
            $this->validateLogin($request);

            if (!$this->attemptLogin($request)) {
                return response(['status' => 'error', 'message' => 'username / password salah'], 422);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    private function conditionalLogin($request)
    {
        if ($request->type === 'siswa') {
            $this->fieldLogin = 'nis';
        } elseif ($request->type === 'guru') {
            $this->fieldLogin = 'nip';
        } else {
            $this->fieldLogin = 'email';
        }
    }

    public function username()
    {
        return $this->fieldLogin;
    }
}