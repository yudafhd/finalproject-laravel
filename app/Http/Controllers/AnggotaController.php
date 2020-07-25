<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Okp;
use App\Exports\AnggotaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{

    public function index(Request $request)
    {
        $data_anggota = [];
        $anggotas = Okp::with('anggota')->whereUserId(auth()->user()->id)->get();
        if (count($anggotas)) {
            $data_anggota = $anggotas[0]->anggota;
        }

        if (auth()->user()->level == 'superadmin' || auth()->user()->level == 'admin_knpi') {
            $data_anggota = Anggota::all();
        }


        $success_message = $request->session()->get('alert-success');
        return view('anggotas.anggotaList',  ['anggotas' => $data_anggota, 'success_message' => $success_message]);
    }

    public function create()
    {
        $is_not_okp_admin = false;
        $okps = null;
        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $is_not_okp_admin = true;
            $okps = Okp::all();
        }
        return view('anggotas.anggotaCreate', ['is_not_okp_admin' => $is_not_okp_admin, 'okps' => $okps]);
    }

    public function store(Request $request)
    {
        try {

            $anggota = Anggota::create($request->all());

            if ($request->okp_id) {
                $anggota->okp_id = $request->okp_id;
            } else {
                $anggota->okp_id = auth()->user()->okp->id;
            }

            $anggota->save();
            $request->session()->flash('alert-success', "Berhasil di buat!");
            return redirect('/anggota');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/anggota/create');
        }
    }

    public function show(Anggota $anggota)
    {
        //
    }

    public function edit($id)
    {
        $is_not_okp_admin = false;
        $okps = null;
        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $is_not_okp_admin = true;
            $okps = Okp::all();
        }
        $anggota = Anggota::find($id);
        return view('anggotas.anggotaUpdate', ['anggota' => $anggota, 'is_not_okp_admin' => $is_not_okp_admin, 'okps' => $okps]);
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        try {
            //
            $anggota->nama = $request->nama;
            $anggota->jabatan = $request->jabatan;
            $anggota->tanggal_masuk = $request->tanggal_masuk;
            $anggota->alamat = $request->alamat;
            $anggota->status = $request->status;
            if ($request->okp_id) {
                $anggota->okp_id = $request->okp_id;
            }
            $anggota->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect('/anggota');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/anggota/' . $anggota->id . 'edit');
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $anggota = Anggota::find($id);
            $anggota->delete();
            $request->session()->flash('alert-success', "Berhasil di hapus!");
            return redirect('/anggota');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/anggota/create');
        }
    }
    
    public function downloadReport()
    {
        return Excel::download(new AnggotaExport(), 'anggota.xlsx');
    }
}