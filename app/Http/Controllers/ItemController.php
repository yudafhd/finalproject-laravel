<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

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
        //
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        //
    }

    public function update(Request $request, Item $item)
    {
        //
    }

    public function destroy(Item $item)
    {
        //
    }
}