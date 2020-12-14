<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type, Request $request)
    {
        if (!in_array($type, ['admin', 'guru', 'siswa'])) {
            return abort(404);
        }

        $userList = User::all()->where('type', $type);;
        $success_message = $request->session()->get('alert-success');
        return view('backoffice.users.userList',  ['type' => $type, 'userList' => $userList, 'success_message' => $success_message]);
    }

    public function create()
    {
        $roles = Role::all();
        $kelas = Kelas::all();
        return view('backoffice.users.userCreate', compact('roles', 'kelas'));
    }

    public function store(Request $request)
    {
        try {
            $roles = Role::findByName($request->type);

            $additional = [
                'password' => bcrypt('adminadmin'),
                'type' => $roles->name
            ];
            $user = User::create(array_merge($request->all(), $additional));

            $user->syncRoles($roles->name);

            $request->session()->flash('alert-success', "User {$request->name} berhasil di buat!");
            return redirect('/user/' . $request->type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/user/' . $request->type);
        }
    }


    public function update($id)
    {
        $userDetail = User::find($id);
        $roles = Role::all();
        $kelas = Kelas::all();
        $isHasGeneral = true;
        return view('backoffice.users.userUpdate',  ['isHasGeneral' => $isHasGeneral, 'userDetail' => $userDetail, 'kelas' => $kelas, 'roles' => $roles]);
    }

    public function storeUpdate(Request $request)
    {
        try {
            $roles = Role::findByName($request->type);
            $userDetail = User::find($request->id);

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->type = $roles->name;
            }

            if ($roles) {
                if ($roles->name != 'guru') {
                    $userDetail->kelas_id = $request->kelas_id;
                }
            }

            $userDetail->name = $request->name;
            $userDetail->username = $request->username;
            $userDetail->email = $request->email;
            $userDetail->dob = $request->dob;
            $userDetail->address = $request->address;
            $userDetail->city = $request->city;
            $userDetail->short_info = $request->short_info;
            $userDetail->city = $request->city;
            $userDetail->nis = $request->nis;
            $userDetail->nip = $request->nip;
            $userDetail->phone_number = $request->phone_number;
            $userDetail->parent_name = $request->parent_name;

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $request->type);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/' . $request->type);
        }
    }

    public function profile()
    {
        return view('backoffice.users.profile',  []);
    }

    public function storeUpdateProfile(Request $request)
    {
        try {
            $roles = null;

            if ($request->type) {
                $roles = Role::findByName($request->type);
            }

            $userDetail = User::find($request->id);

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->type = $roles->name;
            }

            $imagename = null;
            if ($request->file('foto')) {
                // Decode image
                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $path = '/user/profile/' . auth()->user()->id . '/' . $imagename;
                $imagesBatch = Image::make($request->file('foto'))->resize(300, 300)->encode('jpg');

                // Save proccess
                Storage::disk('public')->put($path, $imagesBatch);
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->phone_number = $request->phone_number;
            $userDetail->photo = $imagename;
            $userDetail->address = $request->address;

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/profile');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/profile');
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
