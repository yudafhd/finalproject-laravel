<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Ewarong;
use App\Item;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $user_access = auth()->user()->access_type;
        $stocks = Stock::all();

        if ($user_access != 'superadmin') {
            $rpks = Ewarong::where('user_id', $user_id)->get()->first();
            $stocks = $stocks->where('ewarong_id', $rpks->id);
        }


        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('rpk.stockList',  ['stocks' => $stocks, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {

        $user_id = auth()->user()->id;
        $user_access = auth()->user()->access_type;
        $stocks = Stock::all();
        $rpks = Ewarong::all();
        $items = Item::all();

        if ($user_access != 'superadmin') {
            $rpks = $rpks->where('user_id',  $user_id)->first();
            $stocks = $stocks->where('ewarong_id', $rpks->id);
        }

        $error_message = $request->session()->get('alert-error');
        return view(
            'rpk.stockCreate',
            [
                'items' => $items,
                'rpks' => $rpks,
                'error_message' => $error_message
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            $stock = Stock::create($request->all());
            $stock->save();
            $request->session()->flash('alert-success', "Kios berhasil dibuat!");
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('stock.create');
        }
    }

    public function show(Stock $stock)
    {
        //
    }

    public function edit(Request $request, Stock $stock)
    {
        $user_id = auth()->user()->id;
        $user_access = auth()->user()->access_type;
        $stocks = Stock::all();
        $rpks = Ewarong::all();
        $items = Item::all();

        if ($user_access != 'superadmin') {
            $rpks = $rpks->where('user_id',  $user_id)->first();
            $stocks = $stocks->where('ewarong_id', $rpks->id);
        }

        $error_message = $request->session()->get('alert-error');
        return view('rpk.stockUpdate', [
            'stock' => $stock,
            'items' => $items,
            'rpks' => $rpks,
            'error_message' => $error_message
        ]);
    }

    public function update(Request $request, Stock $stock)
    {
        try {
            $stock->ewarong_id = $request->ewarong_id;
            $stock->item_id = $request->item_id;
            $stock->qty = $request->qty;
            $stock->harga = $request->harga;
            $stock->save();
            $request->session()->flash('alert-success', "Stock berhasil di perbarui!");
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('stock.index');
        }
    }

    public function destroy(Request $request, Stock $stock)
    {
        try {
            $stock->delete();
            $request->session()->flash('alert-success', "Item berhasil dihapus!");
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('stock.index');
        }
    }
}