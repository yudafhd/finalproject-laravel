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
    public function index(Request $request)
    {
        $user = auth()->user();
        $semester = date('m', strtotime($request->date)) - 1 < 6 ? 'genap' : 'ganjil';
        $date = date('Y-m-d', $request->date);
        $year = date('Y', $request->date);
        $day = $this->switchDayName(date('D', $request->date));
        $hours = date('H:i:s', $request->date);

        $schedules_today = Schedules::with(['subject'])
            ->where('class_id', '=', $user->class_id)
            ->where('day', '=', $day)
            ->where('semester', '=', $semester)
            ->where('year', '=', $year)
            ->orderBy('start_at')
            ->get();

        $absent_today = Absents::where('date_absent', '=', $date)
            ->where('user_id', '=', $user->id)
            ->get();

        $schedule_ids = $absent_today->pluck(['schedule_id'])->toArray();

        foreach ($schedules_today as $value) {
            if (in_array($value->id, $schedule_ids)) {
                $value->absenteeism = $this->getReasonById($value->id, $absent_today);
            } else {
                if ($value->end_at <= $hours) {
                    $value->absenteeism = 'hadir';
                } else {
                    $value->absenteeism = 'belum terjadwal';
                }
            }
        }
        return response(['data' => [
            'schedules_absent_today' => $schedules_today,

        ]]);
    }

    public function allEwarong(Request $request)
    {
        $after = [];
        $all_warong = Ewarong::with(['pemesanan', 'stock' => function ($query)  use ($request) {
            if ($request->items) {
                $query->whereIn('item_id', $request->items);
            }
        }, 'stock.item']);

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
        return response(['data' => $districts]);
    }
    public function allVillages(Request $request)
    {
        $district_id = $request->district_id;
        $villages = Villages::all()->where('district_id', $district_id);
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
        $data = Pemesanan::with(['ewarong', 'detail', 'detail.item'])->where('user_id', $user->id)->get();
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
                ]);

                $stockdata = Stock::where('ewarong_id', $ewarong_id)
                    ->where('item_id', $item['id'])->get()->first();
                $updateStock = Stock::where('ewarong_id', $ewarong_id)
                    ->where('item_id', $item['id']);
                $updateStock->update(['qty' => $stockdata->qty - $item['qty']]);
            }
            return response(['status' => 'success', 'message' => 'pesanan berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}