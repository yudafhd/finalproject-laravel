<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleList()
    {
        $roles = Roles::all();
        $user = Auth::user();
        return view('settings.rolesList',  ['user' => $user, 'roles' => $roles]);
    }

    public function createRole()
    {
        $roles = Roles::all();
        $user = Auth::user();
        return view('settings.rolesList',  ['user' => $user, 'roles' => $roles]);
    }
}