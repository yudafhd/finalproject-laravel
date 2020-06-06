<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $items = Item::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('items.itemsList',  ['items' => $items, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('items.itemsCreate',  ['error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        try {
            $items = Item::create($request->all());
            $items->save();
            $request->session()->flash('alert-success', "Item berhasil dibuat!");
            return redirect()->route('item.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('item.create');
        }
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Request $request, Item $item)
    {
        $error_message = $request->session()->get('alert-error');
        return view('items.itemsUpdate', ['item' => $item, 'error_message' => $error_message]);
    }

    public function update(Request $request, Item $item)
    {
        try {
            $item->nama = $request->nama;
            $item->deskripsi = $request->deskripsi;
            $item->save();
            $request->session()->flash('alert-success', "Item berhasil di perbarui!");
            return redirect()->route('item.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('item.index');
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