<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index($type, Request $request)
    {
        if (!in_array($type, ['admin', 'general'])) {
            return abort(404);
        }

        $userList = User::all()->where('access_type', $type);
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
            return redirect('/user/' . $url_type);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/user/' . $url_type);
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
            $userDetail = User::find($request->id);
            $roles = Role::findByName($request->access_type);

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 777, true);
                }

                if (file_exists(public_path() . '/user/profile/' . $userDetail->image_url)) {
                    Storage::delete(public_path() . '/user/profile/' . $userDetail->image_url);
                }

                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $oriPath = public_path() . '/user/profile/' . $imagename;
                Image::make($request->file('foto'))->fit(300, 300)->save($oriPath);
            }

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->access_type = $roles->name;
            }

            if ($request->date_register) {
                $userDetail->date_register = $request->date_register;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->address = $request->address;
            $userDetail->district_id = $request->district_id;
            $userDetail->village_id = $request->village_id;

            if ($request->file('foto')) {
                $userDetail->image_url = $imagename;
            }

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $url_type = $request->access_type;
            if ($url_type == 'rpk') {
                $url_type = 'ewarong';
            }

            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $url_type);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/admin');
        }
    }

    public function storeGeneralUpdate(Request $request)
    {
        try {
            $userDetail = User::find($request->id);
            $roles = Role::findByName($request->access_type);

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 777, true);
                }

                if (file_exists(public_path() . '/user/profile/' . $userDetail->image_url)) {
                    Storage::delete(public_path() . '/user/profile/' . $userDetail->image_url);
                }

                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $oriPath = public_path() . '/user/profile/' . $imagename;
                Image::make($request->file('foto'))->fit(300, 300)->save($oriPath);
            }

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->access_type = $roles->name;
            }

            if ($request->date_register) {
                $userDetail->date_register = $request->date_register;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->address = $request->address;
            $userDetail->district_id = $request->district_id;
            $userDetail->village_id = $request->village_id;

            if ($request->file('foto')) {
                $userDetail->image_url = $imagename;
            }

            if ($request->password) {
                $userDetail->password = bcrypt($request->password);
            }

            $url_type = $request->access_type;
            if ($url_type == 'rpk') {
                $url_type = 'ewarong';
            }

            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $url_type);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/admin');
        }
    }

    public function storeUpdateProfile(Request $request)
    {
        try {
            $roles = null;
            $userDetail = User::find($request->id);

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 777, true);
                }

                $verifynull_image = $userDetail->image_url ? $userDetail->image_url : 'null.jpg';

                if (file_exists(public_path() . '/user/profile/' . $verifynull_image)) {
                    Storage::delete(public_path() . '/user/profile/' . $userDetail->image_url);
                }

                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $oriPath = public_path() . '/user/profile/' . $imagename;
                Image::make($request->file('foto'))->fit(300, 300)->save($oriPath);
            }

            if ($request->access_type) {
                $roles = Role::findByName($request->access_type);
            }

            // assign role to user
            if ($roles) {
                $userDetail->syncRoles([$roles->name]);
                $userDetail->access_type = $roles->name;
            }

            if ($request->date_register) {
                $userDetail->date_register = $request->date_register;
            }

            $userDetail->name = $request->name;
            $userDetail->email = $request->email;
            $userDetail->address = $request->address;
            if ($request->file('foto')) {
                $userDetail->image_url = $imagename;
            }

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

    public function profile()
    {
        return view('users.profile');
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