<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationTokenController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->notification_token;

        try {

            $user = User::find(auth()->user()->id);
            $user->notification_token = $token;
            $user->save();

            return response(['status' => 'success', 'message' => 'Token FCM berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}
