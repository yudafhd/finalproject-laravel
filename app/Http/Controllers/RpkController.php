<?php

namespace App\Http\Controllers;

use App\User;
use App\Villages;
use App\Districts;
use App\Ewarong;
use Illuminate\Http\Request;

class RpkController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $rpks = Ewarong::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('rpk.rpkList',  ['rpks' => $rpks, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $districts = Districts::all()->whereIn('regency_id', [3576, 3516]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        $users = User::all()->where('access_type', 'rpk');
        $error_message = $request->session()->get('alert-error');
        return view(
            'rpk.rpkCreate',
            [
                'districts' => $districts,
                'villages' => $villages,
                'users' => $users,
                'error_message' => $error_message
            ]
        );
    }

    public function store(Request $request)
    {
        $all_request =  $request->all();
        try {
            $classes = Ewarong::create($all_request);
            $classes->save();
            $request->session()->flash('alert-success', "Kios berhasil dibuat!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.create');
        }
    }

    public function show(Ewarong $rpk)
    {
        //
    }

    public function edit(Request $request, Ewarong $rpk)
    {
        $districts = Districts::all()->whereIn('regency_id', [3576, 3516]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        $users = User::all()->where('access_type', 'rpk');
        $error_message = $request->session()->get('alert-error');
        return view('rpk.rpkUpdate', [
            'districts' => $districts,
            'villages' => $villages,
            'rpk' => $rpk,
            'users' => $users,
            'error_message' => $error_message
        ]);
    }


    public function update(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->user_id = $request->user_id;
            $rpk->telp = $request->telp;
            $rpk->nama_kios = $request->nama_kios;
            $rpk->latitude = $request->latitude;
            $rpk->longitude = $request->longitude;
            $rpk->jam_buka = $request->jam_buka;
            $rpk->lokasi = $request->lokasi;
            $rpk->village_id = $request->village_id;
            $rpk->district_id = $request->district_id;
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.index');
        }
    }

    public function verify(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'ACTIVE';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.index');
        }
    }

    public function disable(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'DISABLED';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.index');
        }
    }

    public function reject(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'REJECT';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.index');
        }
    }

    public function active(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'ACTIVE';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.index');
        }
    }

    public function destroy(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->delete();
            $request->session()->flash('alert-success', "RPK berhasil dihapus!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('rpk.index');
        }
    }
}