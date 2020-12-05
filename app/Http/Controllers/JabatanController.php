<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Okp;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];

        if (auth()->user()->level == 'superadmin' || auth()->user()->level == 'admin_knpi') {
            $data = Jabatan::all();
        } else {
            $data = Jabatan::with('okp')->whereOkpId(auth()->user()->okp()->id)->get();
        }

        $success_message = $request->session()->get('alert-success');
        return view('jabatans.jabatanList',  ['jabatans' => $data, 'success_message' => $success_message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_not_okp_admin = false;
        $okps = null;
        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $is_not_okp_admin = true;
            $okps = Okp::all();
        }
        return view('jabatans.jabatanCreate', ['is_not_okp_admin' => $is_not_okp_admin, 'okps' => $okps]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $anggota = Jabatan::create($request->all());

            if ($request->okp_id) {
                $anggota->okp_id = $request->okp_id;
            } else {
                $anggota->okp_id = auth()->user()->okp->id;
            }
            $anggota->save();
            $request->session()->flash('alert-success', "Berhasil di buat!");
            return redirect('/jabatan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/jabatan/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan, Request $request)
    {
        try {
            $jabatan->delete();
            $request->session()->flash('alert-success', "Berhasil di hapus!");
            return redirect('/jabatan');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/jabatan/create');
        }
    }
}
