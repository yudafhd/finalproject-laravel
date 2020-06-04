<?php

namespace App\Http\Controllers;

use App\User;
use App\Classes;
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
        if (!in_array($type, ['admin', 'umum', 'rpk'])) {
            return abort(404);
        }

        $userList = User::all()->where('access_type', $type);;
        $success_message = $request->session()->get('alert-success');
        return view('users.userList',  ['userList' => $userList, 'success_message' => $success_message]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.userCreate',  ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        try {
            $roles = Role::findByName($request->access_type);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'access_type' => $roles->name,
                'date_register' => $request->date_register,
                'address' => $request->address,
                'password' => bcrypt('Rpkbulog'),

            ]);
            $user->syncRoles($roles->name);
            $request->session()->flash('alert-success', "User {$request->name} berhasil di buat!");
            return redirect('/user/' . $request->access_type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/user/' . $request->access_type);
        }
    }


    public function update($id)
    {
        $userDetail = User::find($id);
        $roles = Role::all();
        return view('users.userUpdate',  ['userDetail' => $userDetail, 'roles' => $roles]);
    }

    public function storeUpdate(Request $request)
    {
        try {
            $roles = Role::findByName($request->access_type);
            $userDetail = User::find($request->id);

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->access_type = $roles->name;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->date_register = $request->date_register;
            $userDetail->address = $request->address;

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $request->access_type);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/admin/' . $request->access_type);
        }
    }

    public function delete($id, Request $request)
    {
        try {

            $user = User::find($id);
            $user->syncRoles();
            $user->delete();
            $request->session()->flash('alert-success', "User {$user->name} berhasil dihapus!");
            return redirect('/user/' . $user->access_type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/user/' . $user->access_type);
        }
    }
}