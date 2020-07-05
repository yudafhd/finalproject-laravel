<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $user_class_id = auth()->user()->class_id;
        if ($user_class_id) {
            $user->class = auth()->user()->class;
        }
        return response(['status' => 'success', 'data' => $user]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();
            $userDetail = User::find($user->id);

            if ($request->name) {
                $userDetail->name = $request->name;
            }
            if ($request->address) {
                $userDetail->address = $request->address;
            }
            if ($request->email) {
                $userDetail->email = $request->email;
            }

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $userDetail->save();
            return response(['status' => 'success', 'data' => 'Berhasil update profile']);
        } catch (\Exception $e) {
            return response(['status' => 'error', $e->getMessage()], 422);
        }
    }
}