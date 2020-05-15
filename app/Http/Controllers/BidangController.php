<?php

namespace App\Http\Controllers;

use App\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{

    public function index(Request $request)
    {
        $bidangs = Bidang::all();
        $success_message = $request->session()->get('alert-success');
        return view('bidangs.bidangList', ['success_message' => $success_message, 'bidangs' => $bidangs]);
    }

    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('bidangs.bidangCreate', ['error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        try {
            Bidang::create($request->all())->save();
            $request->session()->flash('alert-success', "Berhasil di buat!");
            return redirect('/bidang');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/bidang/create');
        }
    }

    public function show(Bidang $bidang)
    {
        //
    }

    public function edit(Bidang $bidang, Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('bidangs.bidangUpdate', ['bidang' => $bidang, 'error_message' =>  $error_message]);
    }

    public function update(Request $request, Bidang $bidang)
    {
        try {
            $bidang->nama = $request->nama;
            $bidang->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect('/bidang');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/bidang/' . $request->id . 'edit');
        }
    }

    public function destroy(Bidang $bidang, Request $request)
    {
        try {
            $bidang->delete();
            $request->session()->flash('alert-success', "Berhasil di hapus!");
            return redirect('/bidang');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/bidang');
        }
    }
}