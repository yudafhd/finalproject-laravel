<?php

namespace App\Http\Controllers;

use App\Item;
use App\Pemesanan;
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
        $pemesanans = Pemesanan::all();
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
            compact('pemesanan', 'success_message', 'alert_error')
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

    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
}