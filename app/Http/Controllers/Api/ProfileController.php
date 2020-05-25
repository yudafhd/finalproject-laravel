<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}