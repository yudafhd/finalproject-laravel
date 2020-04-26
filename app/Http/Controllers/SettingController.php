<?php

namespace App\Http\Controllers;

use App\Roles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleList(Request $request)
    {
        $roles = Roles::orderBy('id', 'DESC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('settings.rolesList',  ['user' => $user, 'roles' => $roles, 'success_message' => $success_message]);
    }

    public function createRole(Request $request)
    {
        $roles = Roles::all();
        $user = Auth::user();
        $error_message = $request->session()->get('alert-error');
        return view('settings.rolesCreate',  ['user' => $user, 'roles' => $roles, 'error_message' => $error_message]);
    }

    public function storeRole(Request $request)
    {
        $user = Auth::user();
        try {
            Role::create(['name' => $request->all()['name'], 'created_by' => $user->id]);
            $request->session()->flash('alert-success', "Roles {$request->name} berhasil dibuat!");
            return redirect()->route('role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $request->all()['name'] . " sudah ada!");
            return redirect()->route('role.create');
        }
    }

    public function updateRole($id, Request $request)
    {
        try {
            $roles = Role::findById(urldecode((int) $id));
            $user = Auth::user();
            return view('settings.rolesUpdate',  ['user' => $user, 'roles' => $roles]);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('role.list');
        }
    }
    public function deleteRole($name, Request $request)
    {
        try {

            $roles = Role::findByName($name);
            $roles->delete();
            $request->session()->flash('alert-success', "Roles {$name} berhasil dihapus!");
            return redirect()->route('role.list');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('role.list');
        }
    }

    public function permissionList(Request $request)
    {
        $permissions = Permission::orderBy('id', 'DESC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('settings.pemissionsList',  ['user' => $user, 'permissions' => $permissions, 'success_message' => $success_message]);
    }


    public function createPermission(Request $request)
    {
        $permissions = Permission::all();
        $user = Auth::user();
        $error_message = $request->session()->get('alert-error');
        return view('settings.permissionsCreate',  ['user' => $user, 'permissions' => $permissions, 'error_message' => $error_message]);
    }

    public function storePermission(Request $request)
    {
        $user = Auth::user();
        try {
            Permission::create(['name' => $request->all()['name'], 'created_by' => $user->id]);
            $request->session()->flash('alert-success', "Permission {$request->name} berhasil dibuat!");
            return redirect()->route('permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $request->all()['name'] . " sudah ada!");
            return redirect()->route('role.create');
        }
    }
}