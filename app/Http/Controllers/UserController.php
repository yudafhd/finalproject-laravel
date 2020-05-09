<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type, Request $request)
    {

        $user = Auth::user();
        $userList = User::all()->where('type', $type);
        $success_message = $request->session()->get('alert-success');
        return view('users.userList',  ['user' => $user, 'userList' => $userList, 'success_message' => $success_message]);
    }

    public function createManual()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('users.userCreate',  ['user' => $user, 'roles' => $roles]);
    }

    public function update($id)
    {
        $user = Auth::user();
        $userDetail = User::find($id);
        $roles = Role::all();
        return view('users.userUpdate',  ['user' => $user, 'userDetail' => $userDetail, 'roles' => $roles]);
    }

    public function storeUpdate(Request $request)
    {
        try {
            $roles = Role::findByName($request->type_user);
            $userDetail = User::find($request->id);
            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->type = $request->type_user;
            $userDetail->role_id = $roles->id;
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/admin');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/admin');
        }
    }
}