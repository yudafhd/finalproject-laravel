<?php

namespace App\Http\Controllers;

use App\User;
use App\Villages;
use App\Districts;
use App\Ewarong;
use App\Pemesanan;
use Illuminate\Http\Request;

class RpkController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $user_access = auth()->user()->access_type;
        $rpks = Ewarong::all();

        if ($user_access != 'superadmin') {
            $rpks = $rpks->where('user_id', $user_id);
        }

        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('rpk.rpkList',  ['rpks' => $rpks, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $districts = Districts::all()->whereIn('regency_id', [3515]);
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
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.create');
        }
    }

    public function show(Ewarong $rpk)
    {
        //
    }

    public function edit(Request $request, Ewarong $ewarong)
    {
        $districts = Districts::all()->whereIn('regency_id', [3515]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        $users = User::all()->where('access_type', 'rpk');
        $error_message = $request->session()->get('alert-error');
        return view('rpk.rpkUpdate', [
            'districts' => $districts,
            'villages' => $villages,
            'rpk' => $ewarong,
            'users' => $users,
            'error_message' => $error_message
        ]);
    }


    public function update(Request $request, Ewarong $ewarong)
    {
        try {
            $ewarong->user_id = $request->user_id;
            $ewarong->telp = $request->telp;
            $ewarong->nama_kios = $request->nama_kios;
            $ewarong->latitude = $request->latitude;
            $ewarong->longitude = $request->longitude;
            $ewarong->jam_buka = $request->jam_buka;
            $ewarong->lokasi = $request->lokasi;
            $ewarong->village_id = $request->village_id;
            $ewarong->district_id = $request->district_id;
            $ewarong->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.index');
        }
    }

    public function verify(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'ACTIVE';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.index');
        }
    }

    public function disable(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'DISABLED';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.index');
        }
    }

    public function reject(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'REJECT';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.index');
        }
    }

    public function active(Request $request, Ewarong $rpk)
    {
        try {
            $rpk->status = 'ACTIVE';
            $rpk->save();
            $request->session()->flash('alert-success', "Ewarong berhasil di perbarui!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('ewarong.index');
        }
    }

    public function destroy(Request $request, Ewarong $ewarong)
    {
        try {
            $pemesanan = Pemesanan::where('ewarong_id', $ewarong->id);
            $pemesanan->delete();
            $ewarong->delete();
            $request->session()->flash('alert-success', "RPK berhasil dihapus!");
            return redirect()->route('ewarong.index');
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('ewarong.index');
        }
    }
}