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
        $roles = Roles::orderBy('updated_at', 'ASC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('settings.rolesList',  ['user' => $user, 'roles' => $roles, 'success_message' => $success_message]);
    }

    public function createRole(Request $request)
    {
        $roles = Roles::all();
        $permissions = Permission::all();
        $user = Auth::user();
        $error_message = $request->session()->get('alert-error');
        return view('settings.rolesCreate',  ['user' => $user, 'roles' => $roles, 'permissions' => $permissions, 'error_message' => $error_message]);
    }

    public function storeRole(Request $request)
    {
        $user = Auth::user();
        try {
            $roles = Role::create(['name' => $request->all()['name']]);
            if ($request->permissions_check) {
                if (count($request->permissions_check)) {
                    $permission_collection = [];
                    foreach ($request->permissions_check as $permission) {
                        array_push($permission_collection, $permission);
                    }
                    $roles->syncPermissions($permission_collection);
                }
            }
            $request->session()->flash('alert-success', "Roles {$request->name} berhasil dibuat!");
            return redirect()->route('role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('role.create');
        }
    }

    public function updateRole($id, Request $request)
    {
        try {
            $roles = Role::findById(urldecode((int) $id));
            $rolesPermission = $roles->permissions->pluck('name')->toArray();
            $permissions = Permission::orderBy('name', 'ASC')->get();
            $user = Auth::user();
            return view('settings.rolesUpdate',  [
                'user' => $user,
                'roles' => $roles,
                'rolesPermission' => $rolesPermission,
                'permissions' => $permissions
            ]);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('role.list');
        }
    }
    public function storeUpdateRole(Request $request)
    {

        try {
            $roles = Role::findById(urldecode((int) $request->id));

            if ($request->permissions_check == null) {
                $roles->syncPermissions();
            }
            if (count($request->permissions_check)) {
                $permission_collection = [];
                foreach ($request->permissions_check as $permission) {
                    array_push($permission_collection, $permission);
                }
                $roles->syncPermissions($permission_collection);
            }

            $roles->name = $request->name;
            $roles->save();
            $request->session()->flash('alert-success', "Roles {$request->name} berhasil di update  !");
            return redirect()->route('role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('role.list');
        }
    }

    public function deleteRole($name, Request $request)
    {
        try {

            $roles = Role::findByName($name);
            $roles->syncPermissions();
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
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('settings.pemissionsList',  ['user' => $user, 'permissions' => $permissions, 'success_message' => $success_message]);
    }


    public function createPermission(Request $request)
    {
        $roles = Roles::all();
        $user = Auth::user();
        $error_message = $request->session()->get('alert-error');
        return view('settings.permissionsCreate',  ['user' => $user, 'roles' => $roles, 'error_message' => $error_message]);
    }

    public function storePermission(Request $request)
    {
        $user = Auth::user();
        try {
            Permission::create(['name' => $request->all()['name']]);
            $request->session()->flash('alert-success', "Permission {$request->name} berhasil dibuat!");
            return redirect()->route('permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $request->all()['name'] . " sudah ada!");
            return redirect()->route('role.create');
        }
    }

    public function deletePermission($name, Request $request)
    {
        try {

            $permission = Permission::findByName($name);
            $permission->syncRoles();
            $permission->delete();
            $request->session()->flash('alert-success', "Permission {$name} berhasil dihapus!");
            return redirect()->route('permission.list');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Permission " . $e->getMessage());
            return redirect()->route('permission.list');
        }
    }

    public function updatePermission($id, Request $request)
    {
        try {
            $permissions = Permission::findById(urldecode((int) $id));
            $roles = Roles::all();
            $user = Auth::user();
            return view('settings.permissionsUpdate',  ['user' => $user, 'permissions' => $permissions, 'roles' => $roles]);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Something " . $e->getMessage());
            return redirect()->route('permission.list');
        }
    }

    public function storeUpdatePermission(Request $request)
    {
        try {
            $permissions = Permission::findById(urldecode((int) $request->id));
            $permissions->name = $request->name;
            $permissions->save();
            $request->session()->flash('alert-success', "Permissions {$permissions->name} berhasil di update  !");
            return redirect()->route('permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Permissions " . $e->getMessage());
            return redirect()->route('permission.list');
        }
    }
}