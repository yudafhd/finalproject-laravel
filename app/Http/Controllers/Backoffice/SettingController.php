<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function roleList(Request $request)
    {
        $user = Auth::user();
        $roles = Roles::orderBy('updated_at', 'DESC')->get();
        return view('backoffice.settings.rolesList', compact('roles'));
    }

    public function createRole(Request $request)
    {
        $user = Auth::user();
        $roles = Roles::all();
        $permissions = Permission::all();
        return view('backoffice.settings.rolesCreate', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];

        try {
            $roles = Role::create($data);
            if ($request->permissions_check) {
                if (count($request->permissions_check)) {
                    $permission_collection = [];
                    foreach ($request->permissions_check as $permission) {
                        array_push($permission_collection, $permission);
                    }
                    $roles->syncPermissions($permission_collection);
                }
            }
            $request->session()->flash('alert-success', "Roles {$request->name} created!");
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.role.create');
        }
    }

    public function updateRole($id, Request $request)
    {
        $permissions = Permission::all();
        $roles = Role::findOrFail(urldecode((int) $id));
        $rolesPermission = $roles->permissions->pluck('name')->toArray();
        return view('backoffice.settings.rolesUpdate', compact('roles', 'rolesPermission', 'permissions'));
    }

    public function storeUpdateRole(Request $request)
    {
        try {
            $roles = Role::findById(urldecode((int) $request->id));
            if ($request->permissions_check == null) {
                $roles->syncPermissions();
            } else {
                $permission_collection = [];
                foreach ($request->permissions_check as $permission) {
                    array_push($permission_collection, $permission);
                }
                $roles->syncPermissions($permission_collection);
            }

            $roles->name = $request->name;
            $roles->save();
            $request->session()->flash('alert-success', "Roles {$request->name} deleted  !");
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.role.list');
        }
    }

    public function deleteRole($id, Request $request)
    {
        try {
            $rolesData = Role::findOrFail($id);
            $rolesName = $rolesData->name;
            $roles = Role::findByName($rolesName, $rolesData->guard_name);
            $roles->syncPermissions();
            $roles->delete();
            $request->session()->flash('alert-success', "Roles {$rolesName} deleted!");
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.role.list');
        }
    }

    public function permissionList(Request $request)
    {
        $permissions = Permission::orderBy('created_at', 'ASC')->get();
        return view('backoffice.settings.pemissionsList', compact('permissions'));
    }

    public function createPermission(Request $request)
    {
        $permissions = Permission::all()->sortByDesc('created_at');
        return view('backoffice.settings.permissionsCreate', compact('permissions'));
    }

    public function storePermission(Request $request)
    {
        $parent_id_checker = $request->parent_id ? $request->parent_id : null;

        //kurang keamanan saat input bisa di manipulasi lewat doom
        try {
            Permission::create(['name' => $request->name, 'parent_id' => $parent_id_checker]);
            $request->session()->flash('alert-success', "Permission {$request->name} created!");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

    public function updatePermission($id, Request $request)
    {
        try {
            $roles = Roles::all();
            $permissions = Permission::findById(urldecode((int) $id));
            return view('backoffice.settings.permissionsUpdate', compact('permissions', 'roles'));
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

    public function storeUpdatePermission(Request $request)
    {
        try {
            $permissions = Permission::findById(urldecode((int) $request->id));
            $permissions->name = $request->name;
            $permissions->save();
            $request->session()->flash('alert-success', "Permissions {$permissions->name} updated !");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

    public function deletePermission($name, Request $request)
    {
        try {
            $permission = Permission::findByName($name);
            $permission->syncRoles();
            $permission->delete();
            $request->session()->flash('alert-success', "Permission {$name} deleted!");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

}