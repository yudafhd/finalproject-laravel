<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleList()
    {
        $roles = Roles::orderBy('id', 'DESC')->get();
        $user = Auth::user();
        return view('settings.rolesList',  ['user' => $user, 'roles' => $roles]);
    }

    public function createRole()
    {
        $roles = Roles::all();
        $user = Auth::user();
        return view('settings.rolesCreate',  ['user' => $user, 'roles' => $roles]);
    }

    public function storeRole(Request $request)
    {
        $roles = Roles::all();
        $user = Auth::user();
        $role = Role::create(['name' => $request->all()['name'], 'code' => $request->all()['code'], 'created_by' => $user->id]);
        $request->session()->flash('alert-success', "Roles {$request->name} berhasil dibuat!");
        return redirect()->route('role.list');
    }

    // public function create()
    // {
    //     $user = Auth::user();
    //     return view('packages.create',  ['user' => $user]);
    // }

    // public function store(Request $request)
    // {
    //     $package = new BookingPackages;
    //     $package->name = $request->name;
    //     $package->price = $request->price;
    //     $package->description = $request->description;
    //     $package->save();
    //     $request->session()->flash('alert-success', "Paket {$request->name} berhasil dibuat!");
    //     return redirect()->route('package.index');
    // }


    // public function show(BookingPackages $bookingPackages)
    // {
    //     //
    // }

    // public function edit(BookingPackages $package)
    // {
    //     $user = Auth::user();
    //     return view('packages.edit',  ['user' => $user, 'package'=> $package]);
    // }

    // public function update(Request $request, BookingPackages $package)
    // {
    //     $package->name = $request->name;
    //     $package->price = $request->price;
    //     $package->description = $request->description;
    //     $package->save();

    //     return redirect()->route('package.index')
    //     ->with('success','Package updated successfully');
    // }

    // public function destroy( BookingPackages $package)
    // {
    //     $package->delete();
    //     return redirect()->route('package.index')
    //                     ->with('success','Paket deleted successfully');
    // }
}