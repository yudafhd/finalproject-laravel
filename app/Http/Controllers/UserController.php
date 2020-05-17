<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index($type, Request $request)
    {
        if (!in_array($type, ['admin', 'guru', 'siswa'])) {
            return abort(404);
        }

        $userList = User::all()->where('type', $type);;
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
            $roles = Role::findByName($request->type_user);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $roles->name,
                'dob' => $request->dob,
                'address' => $request->address,
                'city' => $request->city,
                'short_info' => $request->short_info,
                'city' => $request->city,
                'nis' => $request->nis,
                'nip' => $request->nip,
                'parent_name' => $request->parent_name,
                'password' => bcrypt('Smkn1user'),

            ]);
            $user->syncRoles($roles->name);
            $request->session()->flash('alert-success', "User {$request->name} berhasil di buat!");
            return redirect('/user/admin');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/user/admin');
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
            $roles = Role::findByName($request->type_user);
            $userDetail = User::find($request->id);

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->type = $roles->name;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->dob = $request->dob;
            $userDetail->address = $request->address;
            $userDetail->city = $request->city;
            $userDetail->short_info = $request->short_info;
            $userDetail->city = $request->city;
            $userDetail->nis = $request->nis;
            $userDetail->nip = $request->nip;
            $userDetail->parent_name = $request->parent_name;

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $request->type_user);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/' . $request->type_user);
        }
    }

    public function delete($id, Request $request)
    {
        try {

            $user = User::find($id);
            $user->syncRoles();
            $user->delete();
            $request->session()->flash('alert-success', "User {$user->name} berhasil dihapus!");
            return redirect('/user/' . $user->type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/user/' . $user->type);
        }
    }
}