<?php

namespace App\Http\Controllers;

use App\Item;
use App\Pemesanan;
use App\PemesananDetail;
use App\User;
use App\Ewarong;
use Illuminate\Http\Request;

class PemesananController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $user_access = auth()->user()->access_type;
        $pemesanans = Pemesanan::all();
        $rpks = Ewarong::all();

        if ($user_access != 'superadmin') {
            $rpks = $rpks->where('user_id', $user_id);
        }

        if ($user_access != 'superadmin') {
            if($rpks->first()) {
                $pemesanans = $pemesanans->where('ewarong_id', $rpks->first()->id);
            }else {
                 $pemesanans = [];
            }
        }
        
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('pemesanan.pemesananList',  ['pemesanans' => $pemesanans, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $users = User::all()->where('access_type', 'umum');
        $items = Item::all();
        $rpks = Ewarong::all();
        $error_message = $request->session()->get('alert-error');
        return view(
            'pemesanan.pemesananCreate',
            [
                'items' => $items,
                'rpks' => $rpks,
                'users' => $users,
                'error_message' => $error_message
            ]
        );
    }

    public function store(Request $request)
    {
    }

    public function show(Pemesanan $pemesanan, Request $request)
    {

        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view(
            'pemesanan.pemesananDetail',
            [
                'pemesanan' => $pemesanan,
                'success_message' => $success_message,
                'alert_error' => $alert_error
            ]
        );
    }

    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        try {
            $pemesanan->status = $request->status;
            $pemesanan->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect()->route('pemesanan.show', $pemesanan->id);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('pemesanan.show', $pemesanan->id);
        }
    }

    public function destroy(Pemesanan $pemesanan, Request $request)
    {
        try {
            $all_detail = PemesananDetail::where('pemesanan_id', $pemesanan->id);
            $all_detail->delete();
            $pemesanan->delete();
            $request->session()->flash('alert-success', "Pemesamam berhasil dihapus!");
            return redirect()->route('pemesanan.index');
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('pemesanan.index');
        }
    }
}