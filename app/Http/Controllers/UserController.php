<?php

namespace App\Http\Controllers;

use App\User;
use App\Villages;
use App\Districts;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $districts = Districts::all()->whereIn('regency_id', [3515]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        $roles = Role::all();
        return view('users.userCreate',  compact('roles', 'districts', 'villages'));
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
                'access_type' => $roles->name,
                'date_register' => $request->date_register,
                'address' => $request->address,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
                'password' => bcrypt('adminadmin'),
                'image_url' => $imagename,

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
        $districts = Districts::all()->whereIn('regency_id', [3515]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        $userDetail = User::find($id);
        $url = Storage::url($userDetail->image_url);
        $roles = Role::all();
        return view('users.userUpdate',  compact('userDetail', 'roles', 'districts', 'villages', 'url'));
    }

    public function storeUpdate(Request $request)
    {
        try {
            $userDetail = User::find($request->id);
            $roles = Role::findByName($request->access_type);

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 666, true);
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
            $userDetail->save();
            $request->session()->flash('alert-success', "User {$request->name} berhasil di update!");
            return redirect('/user/' . $request->access_type);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/user/admin/' . $request->access_type);
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
                    mkdir(public_path() . '/user/profile/', 755, true);
                }

                $verifynull_image = $userDetail->image_url ? $userDetail->image_url : 'null.jpg';

                if (file_exists(public_path() . '/user/profile/' . $verifynull_image)) {
                    Storage::delete(public_path() . '/user/profile/' . $userDetail->image_url);
                    // unlink(public_path() . '/user/profile/' . $userDetail->image_url);
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
        return view('users.profile',  []);
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