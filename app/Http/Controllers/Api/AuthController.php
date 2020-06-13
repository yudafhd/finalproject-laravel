<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Ewarong;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function register(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                return response(['status' => 'error', 'message' => $validator->messages()], 422);
            }

            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'access_type' => $request->type,
                'address' => $request->address,
                'date_register' =>  date('Y-m-d'),
                'password' => Hash::make($request->password),
            ]);

            if ($user->access_type == 'rpk') {
                Ewarong::create([
                    'user_id' => $user->id,
                    'telp' => $request->telp,
                    'nama_kios' => $request->nama_kios,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'jam_buka' => $request->jam_buka,
                    'lokasi' => $request->lokasi,
                    'village_id' => $request->village_id,
                    'district_id' => $request->district_id,
                    'status' => 'PENDING',
                ]);
            }
            return response(['data' => $user]);
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