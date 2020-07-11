<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $items = Satuan::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('satuans.itemsList',  ['items' => $items, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('satuans.itemsCreate',  ['error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        try {
            $items = Satuan::create($request->all());
            $items->save();
            $request->session()->flash('alert-success', "Item berhasil dibuat!");
            return redirect()->route('satuan.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('satuan.create');
        }
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Request $request, Satuan $satuan)
    {
        $error_message = $request->session()->get('alert-error');
        return view('satuans.itemsUpdate', ['item' => $satuan, 'error_message' => $error_message]);
    }

    public function update(Request $request, Satuan $satuan)
    {
        try {
            $item->satuan = $request->nama;
            $item->save();
            $request->session()->flash('alert-success', "Item berhasil di perbarui!");
            return redirect()->route('satuan.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('satuan.index');
        }
    }

    public function destroy(Request $request, Item $item)
    {
        try {
            $item->delete();
            $request->session()->flash('alert-success', "Item berhasil dihapus!");
            return redirect()->route('item.index');
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('item.index');
        }
    }
}