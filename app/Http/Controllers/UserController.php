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

    public function index(Request $request)
    {
        $user = Auth::user();
        $userList = User::all();
        $success_message = $request->session()->get('alert-success');
        return view('users.userList',  ['user' => $user, 'userList' => $userList, 'success_message' => $success_message]);
    }

    public function create()
    {
        $user = Auth::user();
        $roles = Role::all();
        return view('users.userCreate',  ['user' => $user, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        try {
            $roles = Role::findByName($request->level);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $roles->name,
                'password' => bcrypt('admin12345'),

            ]);
            $user->syncRoles($roles->name);
            $request->session()->flash('alert-success', "User {$request->name} berhasil di buat!");
            return redirect('/user');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/user');
        }
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
            $userDetail = User::find($request->id);
            if ($request->level) {
                $roles = Role::findByName($request->level);
                // assign role to user
                $userDetail->syncRoles([$roles->name]);
                $userDetail->level = $roles->name;
            }
            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/update/' . $request->id);
        }
    }

    // Keamanan saat menghapus user kurang
    public function delete($id, Request $request)
    {
        try {

            $user = User::find($id);
            $user->syncRoles();
            $user->delete();
            $request->session()->flash('alert-success', "User {$user->name} berhasil dihapus!");
            return redirect('/user/' . $user->type);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/user/' . $user->type);
        }
    }
}