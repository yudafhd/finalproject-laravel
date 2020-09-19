<?php

namespace App\Http\Controllers\Backoffice;

use App\Admin;
use App\General;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index($type, Request $request)
    {
        if (!in_array($type, ['admin', 'general'])) {
            return abort(404);
        }

        if ($type === 'general') {
            $userList = User::all()->where('access_type', $type);
        } else {
            $userList = User::all()
                ->where('access_type', '!=', 'general')
                ->where('access_type', '!=', 'superadmin');
        }

        return view('backoffice.users.userList', compact('userList'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backoffice.users.userCreate', compact('roles'));
    }

    public function store(Request $request)
    {
        try {

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 666, true);
                }
                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $oriPath = public_path() . '/user/profile/' . $imagename;
                $image = Image::make($request->file('foto'))->resize(300, 200)->save($oriPath);
            }

            $roles = Role::findByName($request->access_type);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'access_type' => $roles->name,
                'password' => bcrypt('adminadmin'),

            ]);

            $url_type = $request->access_type;

            if ($url_type != 'general') {
                $url_type = 'admin';
            }

            // $user->syncRoles($roles->name,'admin');
            $request->session()->flash('alert-success', "User {$request->name} berhasil di buat!");
            return redirect('/backoffice/user/admin');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/backoffice/user/admin');
        }
    }

    public function update($id)
    {
        $roles = Role::all();
        $userDetail = User::findOrFail($id);
        $isHasGeneral = $userDetail->general ? true : false;
        return view('backoffice.users.userUpdate', compact('userDetail', 'roles', 'isHasGeneral'));
    }

    public function storeUpdate(Request $request)
    {
        try {
            $userDetail = Admin::find($request->id);
            $roles = Role::findByName($request->access_type);
            $url_type = $userDetail->access_type;

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles($roles);
                $userDetail->access_type = $roles->name;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->username = $request->username;
            $userDetail->phone_number = $request->phone_number;

            // if user upload image
            if ($request->file('foto')) {

                $imagename = null;
                $ifExist = Storage::exists('public/admin/profile/' . $userDetail->photo);

                if ($ifExist) {
                    Storage::delete('public/admin/profile/' . $userDetail->photo);
                }

                // Decode image
                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $path = '/admin/profile/' . $imagename;
                $imagesBatch = Image::make($request->file('foto'))->fit(150, 150)->encode('jpg');

                // Save proccess
                Storage::disk('public')->put($path, $imagesBatch);
                $userDetail->photo = $imagename;
            }

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} updated!");
            return redirect('backoffice/user/admin');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('backoffice/user/admin');
        }
    }

    public function storeGeneralUpdate(Request $request)
    {
        try {
            $userDetail = User::find($request->id);

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->username = $request->username;
            $userDetail->phone_number = $request->phone_number;
            $url_type = $userDetail->access_type;

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} updated!");
            return redirect('backoffice/user/' . $url_type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('backoffice/user/' . $url_type);
        }
    }

    public function storeUpdateProfile(Request $request)
    {
        try {
            $userDetail = Admin::find($request->id);
            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->username = $request->username;
            $userDetail->phone_number = $request->phone_number;

            // if user upload image
            if ($request->file('foto')) {

                $imagename = null;
                $ifExist = Storage::exists('public/admin/profile/' . $userDetail->photo);

                if ($ifExist) {
                    Storage::delete('public/admin/profile/' . $userDetail->photo);
                }

                // Decode image
                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $path = '/admin/profile/' . $imagename;
                $imagesBatch = Image::make($request->file('foto'))->fit(150, 150)->encode('jpg');

                // Save proccess
                Storage::disk('public')->put($path, $imagesBatch);
                $userDetail->photo = $imagename;
            }

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} updated!");
            return redirect('/backoffice/user/profile');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/backoffice/user/profile');
        }
    }

    public function profile()
    {
        return view('backoffice.users.profile');
    }

    public function delete($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
            $user->syncRoles();
            $user->delete();
            $request->session()->flash('alert-success', "User {$user->name} berhasil dihapus!");
            return redirect()->route('admin.user.list', $user->access_type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.user.list', $user->access_type);
        }
    }
}