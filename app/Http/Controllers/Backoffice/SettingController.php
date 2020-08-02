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
        $roles = Roles::orderBy('updated_at', 'ASC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('backoffice.settings.rolesList', ['user' => $user, 'roles' => $roles, 'success_message' => $success_message]);
    }

    public function createRole(Request $request)
    {
        $roles = Roles::all();
        $permissions = Permission::all();
        $user = Auth::user();
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.settings.rolesCreate', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions, 'error_message' => $error_message]);
    }

    public function storeRole(Request $request)
    {
        $user = Auth::user();
        $data = [
            'name' => $request->name,
            'guard_name' => $request->guard_name,
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
            $request->session()->flash('alert-success', "Roles {$request->name} berhasil dibuat!");
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.role.create');
        }
    }

    public function updateRole($id, Request $request)
    {
        try {
            $roles = Role::find(urldecode((int) $id));
            $rolesPermission = $roles->permissions->pluck('name')->toArray();
            $permissions = Permission::all();
            $user = Auth::user();
            return view('backoffice.settings.rolesUpdate', [
                'user' => $user,
                'roles' => $roles,
                'rolesPermission' => $rolesPermission,
                'permissions' => $permissions,
            ]);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('admin.role.list');
        }
    }
    public function storeUpdateRole(Request $request)
    {

        try {
            $roles = Role::findById(urldecode((int) $request->id), $request->guard_name);

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
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('admin.role.list');
        }
    }

    public function deleteRole($id, Request $request)
    {
        try {
            $rolesData = Role::find($id);
            $rolesName = $rolesData->name;
            $roles = Role::findByName($rolesName, $rolesData->guard_name);
            $roles->syncPermissions();
            $roles->delete();
            $request->session()->flash('alert-success', "Roles {$rolesName} berhasil dihapus!");
            return redirect()->route('admin.role.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $e->getMessage() . " sudah ada!");
            return redirect()->route('admin.role.list');
        }
    }

    public function permissionList(Request $request)
    {
        $permissions = Permission::orderBy('created_at', 'ASC')->get();
        $user = Auth::user();
        $success_message = $request->session()->get('alert-success');
        return view('backoffice.settings.pemissionsList', ['user' => $user, 'permissions' => $permissions, 'success_message' => $success_message]);
    }

    public function createPermission(Request $request)
    {
        $permissions = Permission::all()->sortByDesc('created_at');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.settings.permissionsCreate', ['permissions' => $permissions, 'error_message' => $error_message]);
    }

    public function storePermission(Request $request)
    {
        $parent_id_checker = $request->parent_id ? $request->parent_id : null;

        //kurang keamanan saat input bisa di manipulasi lewat doom
        try {
            Permission::create(['name' => $request->name, 'parent_id' => $parent_id_checker]);
            $request->session()->flash('alert-success', "Permission {$request->name} berhasil dibuat!");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Roles " . $request->all()['name'] . " sudah ada!");
            return redirect()->route('admin.permission.list');
        }
    }

    public function deletePermission($name, Request $request)
    {
        try {

            $permission = Permission::findByName($name);
            $permission->syncRoles();
            $permission->delete();
            $request->session()->flash('alert-success', "Permission {$name} berhasil dihapus!");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Permission " . $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

    public function updatePermission($id, Request $request)
    {
        try {
            $permissions = Permission::findById(urldecode((int) $id));
            $roles = Roles::all();
            $user = Auth::user();
            return view('backoffice.settings.permissionsUpdate', ['user' => $user, 'permissions' => $permissions, 'roles' => $roles]);
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('alert-error', "Something " . $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }

    public function storeUpdatePermission(Request $request)
    {
        try {
            $permissions = Permission::findById(urldecode((int) $request->id));
            $permissions->name = $request->name;
            $permissions->save();
            $request->session()->flash('alert-success', "Permissions {$permissions->name} berhasil di update  !");
            return redirect()->route('admin.permission.list');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', "Permissions " . $e->getMessage());
            return redirect()->route('admin.permission.list');
        }
    }
}