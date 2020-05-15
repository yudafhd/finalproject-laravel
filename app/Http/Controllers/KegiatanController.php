<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use App\Okp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;;

class KegiatanController extends Controller
{

    public function index(Request $request)
    {
        $data_kegiatan = [];
        $kegiatans = Okp::with('kegiatan')->whereUserId(auth()->user()->id)->get();

        if (count($kegiatans)) {
            $data_kegiatan = $kegiatans[0]->kegiatan;
        }

        if (auth()->user()->level == 'superadmin' || auth()->user()->level == 'admin_knpi') {
            $data_kegiatan = Kegiatan::all();
        }

        $success_message = $request->session()->get('alert-success');
        return view('kegiatans.kegiatanList',  ['kegiatans' => $data_kegiatan, 'success_message' => $success_message]);
    }

    public function create()
    {
        $is_not_okp_admin = false;
        $okps = null;
        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $is_not_okp_admin = true;
            $okps = Okp::all();
        }
        return view('kegiatans.kegiatanCreate', ['is_not_okp_admin' => $is_not_okp_admin, 'okps' => $okps]);
    }

    public function store(Request $request)
    {

        try {

            $kegiatan = Kegiatan::create($request->all());

            if ($request->file('foto')) {
                $storage = Storage::putFile('public/kegiatan/photo', $request->file('foto'));
                $kegiatan->foto = basename($storage);
            }

            if ($request->okp_id) {
                $kegiatan->okp_id = $request->okp_id;
            } else {
                $kegiatan->okp_id = auth()->user()->okp->id;
            }

            $kegiatan->save();
            $request->session()->flash('alert-success', "Berhasil di buat!");
            return redirect('/kegiatan');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/kegiatan/create');
        }
    }

    public function show(Kegiatan $kegiatan)
    {
        //
    }

    public function edit(Kegiatan $kegiatan)
    {
        $is_not_okp_admin = false;
        $okps = null;
        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $is_not_okp_admin = true;
            $okps = Okp::all();
        }
        return view('kegiatans.kegiatanUpdate', ['kegiatan' => $kegiatan, 'is_not_okp_admin' => $is_not_okp_admin, 'okps' => $okps]);
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        try {
            //
            $kegiatan->judul = $request->judul;
            $kegiatan->detail_kegiatan = $request->detail_kegiatan;
            $kegiatan->detail_anggaran = $request->detail_anggaran;
            $kegiatan->tanggal_terlaksana = $request->tanggal_terlaksana;
            $kegiatan->sasaran = $request->sasaran;
            $kegiatan->tujuan = $request->tujuan;
            $kegiatan->hasil = $request->hasil;
            $kegiatan->tempat = $request->tempat;

            if ($request->okp_id) {
                $kegiatan->okp_id = $request->okp_id;
            }

            //delete and update foto
            if ($request->file('foto')) {
                Storage::delete('public/kegiatan/photo/' . $kegiatan->foto);
                $storage = Storage::putFile('public/kegiatan/photo', $request->file('foto'));
                $kegiatan->foto = basename($storage);
            }
            $kegiatan->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect('/kegiatan');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/kegiatan/' . $kegiatan->id . 'edit');
        }
    }

    public function destroy(Kegiatan $kegiatan, Request $request)
    {
        try {
            // Delete data kegiatan
            Storage::delete('public/kegiatan/photo/' . $kegiatan->foto);
            $kegiatan->delete();
            $request->session()->flash('alert-success', "Berhasil di hapus!");
            return redirect('/kegiatan');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/kegiatan/create');
        }
    }
}