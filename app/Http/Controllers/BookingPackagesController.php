<?php

namespace App\Http\Controllers;

use App\BookingPackages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingPackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $packages = BookingPackages::all();    
        return view('packages.list',  ['user' => $user,'packages' => $packages]);
    }

    public function create()
    {
        $user = Auth::user();
        return view('packages.create',  ['user' => $user]);
    }

    public function store(Request $request)
    {
        $package = new BookingPackages;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->description = $request->description;
        $package->save();
        $request->session()->flash('alert-success', "Paket {$request->name} berhasil dibuat!");
        return redirect()->route('package.index');
    }

   
    public function show(BookingPackages $bookingPackages)
    {
        //
    }

    public function edit($id)
    {
        $user = Auth::user();
        return view('packages.edit',  ['user' => $user, 'package'=> BookingPackages::find($id)]);
    }

    public function update(Request $request, BookingPackages $bookingPackages)
    {
        $bookingPackages->name = $request->name;
        $bookingPackages->price = $request->price;
        $bookingPackages->description = $request->description;
        $bookingPackages->save();

        return redirect()->route('package.edit', $bookingPackages->id)
        ->with('success','Package updated successfully');
    }

    public function destroy($id)
    {
        BookingPackages::find($id)->delete();
        return redirect()->route('package.index')
                        ->with('success','Paket deleted successfully');
    }
}
