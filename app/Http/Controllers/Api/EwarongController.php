<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ewarong;
use App\Villages;
use App\Districts;
use App\Item;
use App\Pemesanan;
use App\PemesananDetail;
use App\Stock;
use Illuminate\Support\Str;

class EwarongController extends Controller
{
    public function allEwarong(Request $request)
    {
        $after = [];
        $all_warong = Ewarong::with(['pemesanan', 'stock' => function ($query)  use ($request) {
            if ($request->items) {
                $query->whereIn('item_id', $request->items);
            }
        }, 'stock.item', 'stock.satuan']);

        if (!$request->isAll) {
            if ($request->searchname) {
                $all_warong->where('nama_kios', 'like', '%' . $request->searchname . '%');
            }

            if ($request->district_id) {
                $all_warong->where('district_id', $request->district_id);
            }
            if ($request->village_id) {
                $all_warong->where('village_id', $request->village_id);
            }
            if ($request->time) {
                $all_warong->where('jam_buka', '<=', $request->time);
            }
            if ($request->time_close) {
                $all_warong->where('jam_tutup', '>=', $request->time_close);
            }
            $all_warong->where('status', 'ACTIVE');
        }

        $after = $all_warong->get();

        if ($request->items) {
            if (count($after)) {
                $data = [];
                foreach ($after as $after) {
                    if (count($after->stock)) {
                        array_push($data, $after);
                    }
                }
                $after = $data;
            }
        }
        if ($request->usemylocation) {
            $cLat = $request->latitude;
            $clng = $request->longitude;
            $km = $request->km;
            $data = [];
            foreach ($after as $warong) {
                if ($this->checkRadius($cLat, $clng, $warong->latitude, $warong->longitude, $km)) {
                    array_push($data, $warong);
                }
            }
            $after = $data;
        }
        return response(['data' => $after]);
    }
    public function allDistrics()
    {
        $districts = Districts::all()->whereIn('regency_id', [3515]);
        $villages = Villages::all()->whereIn('district_id', $districts->pluck('id'));
        return response(['data' => [
            'districts' => $districts,
            'villages' => $villages,
        ]]);
    }
    public function allVillages(Request $request)
    {
        $district_id = $request->district_id;
        $villages = [];
        if ($district_id && $district_id != 0) {
            $villages = Villages::all()->where('district_id', $district_id);
        } else {
            $villages = Villages::all();
        }
        return response(['data' => $villages]);
    }

    public function allItems()
    {
        $items = Item::all();
        return response(['data' => $items]);
    }

    public function checkRadius($cLat, $clng, $chckLat, $chcklng, $km = 1)
    {
        $ky = 40000 / 360;
        $kx = cos(pi() * $cLat / 180.0) * $ky;
        $dx = abs($clng - $chcklng) * $kx;
        $dy = abs($cLat - $chckLat) * $ky;
        return sqrt($dx * $dx + $dy * $dy) <= $km;
    }

    public function getFromMyRadius(Request $request)
    {
        $data = [];
        $cLat = $request->latitude;
        $clng = $request->longitude;
        $km = $request->km;
        $ewarongs = Ewarong::all();

        foreach ($ewarongs as $warong) {
            if ($this->checkRadius($cLat, $clng, $warong->latitude, $warong->longitude, $km)) {
                array_push($data, $warong);
            }
        }
        return response(['data' => $data]);
    }

    public function getOrderByUser(Request $request)
    {
        $user = auth()->user();
        $access = $user->access_type;
        $ewarong = Ewarong::where('user_id', $user->id)->get()->first();

        if ($access == 'umum' or $access == 'superadmin') {
            $data = Pemesanan::with(['ewarong', 'detail', 'detail.item', 'detail.satuan'])->where('user_id', $user->id)->get();
        }
        if ($access == 'rpk') {
            $data = Pemesanan::with(['ewarong', 'detail', 'detail.item', 'detail.satuan'])->where('ewarong_id', $ewarong->id)->get();
        }
        return response(['data' => $data]);
    }

    public function orderUser(Request $request)
    {
        try {
            $user = auth()->user();
            $ewarong_id = $request->ewarong_id;
            $items = $request->items;
            $qty_total = 0;
            $harga_total = 0;
            foreach ($items as $item) {
                $qty_total = $qty_total + $item['qty'];
                $harga_total = $harga_total + $item['harga'];
            }

            $result = Pemesanan::create([
                'nomor_pemesanan' =>  strtoupper(Str::random(10) . rand(0, date('mm'))),
                'user_id' => $user->id,
                'ewarong_id' => $ewarong_id,
                'qty_total' => $qty_total,
                'harga_total' => $harga_total,
                'status' => 'OPEN',
                'date_pemesanan' => date('Y-m-d')
            ]);

            foreach ($items as $item) {
                PemesananDetail::create([
                    'pemesanan_id' => $result->id,
                    'item_id' => $item['id'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'satuan_id' => $item['satuan_id'],
                    'satuan_number' => $item['satuan_number'],
                ]);

                $stockdata = Stock::where('ewarong_id', $ewarong_id)
                    ->where('item_id', $item['id'])
                    ->where('satuan_id', $item['satuan_id'])
                    ->where('satuan_number', $item['satuan_number'])
                    ->get()->first();
                $updateStock = Stock::where('ewarong_id', $ewarong_id)
                    ->where('item_id', $item['id'])
                    ->where('satuan_id', $item['satuan_id'])
                    ->where('satuan_number', $item['satuan_number']);
                $updateStock->update(['qty' => $stockdata->qty - $item['qty']]);
            }
            return response(['status' => 'success', 'message' => 'pesanan berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
    public function confirmOrder(Request $request)
    {
        try {
            $user = auth()->user();
            $pemesanan = Pemesanan::find($request->pemesanan_id);
            $status = $request->status;
            $pemesanan->update(['status' => $status]);
            return response(['status' => 'success', 'message' => 'Pesanan berhasil ' . $status]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function finishOrder(Request $request)
    {
        try {
            $user = auth()->user();
            $pemesanan = Pemesanan::find($request->pemesanan_id);
            $status = $request->status;
            $pemesanan->update(['status' => $status]);
            return response(['status' => 'success', 'message' => 'Pesanan berhasil ' . $status]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function rejectedOrder(Request $request)
    {
        try {
            $user = auth()->user();
            
            $pemesanans = Pemesanan::find($request->pemesanan_id);
            $pemesananDetail = PemesananDetail::all()->where('pemesanan_id', $pemesanans->id);
            $status = $request->status;

            foreach($pemesananDetail as $pemesanan) {
                $item_id = $pemesanan->item_id;
                $qty = $pemesanan->qty;
                $stocks = Stock::where('ewarong_id', $pemesanans->ewarong_id)->where('item_id', $item_id)->get()->first();
                $stock_id = $stocks->id;
                $stocks_now = $stocks->qty;
                $stocks_after = (int) $stocks_now + (int) $qty;
                Stock::find($stock_id)->update(['qty'=>$stocks_after]);
            }

            $pemesanans->update(['status' => $status]);
            return response(['status' => 'success', 'message' => 'Pesanan berhasil '.$status]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function confirmEwarong(Request $request)
    {
        try {
            $ewarong = Ewarong::find($request->ewarong_id);
            $status = $request->status;
            $ewarong->update(['status' => $status]);
            return response(['status' => 'success', 'message' => 'Ewarong berhasil ' . $status]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}