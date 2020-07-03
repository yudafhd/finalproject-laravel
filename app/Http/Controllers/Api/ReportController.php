<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PemesananDetail;
use App\Ewarong;

class ReportController extends Controller
{
    public function todayChartUser(Request $request)
    {
        $user = auth()->user();
        $access = $user->access_type;
        $ewarong = Ewarong::where('user_id', $user->id)->get()->first();

        $year = date('Y');
        $month = date('m');
        $total_days = 31;

        if ($access == 'umum' or $access == 'superadmin') {
            $pemesanan_detail = PemesananDetail::join('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
                ->where('user_id', $user->id)
                ->whereMonth('pemesanan_detail.created_at',  $month)
                ->whereYear('pemesanan_detail.created_at', $year)
                ->selectRaw('sum(pemesanan_detail.harga) as total_harga, DATE_FORMAT(pemesanan.date_pemesanan, "%d") as day_number')
                ->groupBy('pemesanan.date_pemesanan')
                ->get()
                ->toArray();
        }
        if ($access == 'rpk') {
            $pemesanan_detail = PemesananDetail::join('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
                ->where('ewarong_id', $ewarong->id)
                ->whereMonth('pemesanan_detail.created_at',  $month)
                ->whereYear('pemesanan_detail.created_at', $year)
                ->selectRaw('sum(pemesanan_detail.harga) as total_harga, DATE_FORMAT(pemesanan.date_pemesanan, "%d") as day_number')
                ->groupBy('pemesanan.date_pemesanan')
                ->get()
                ->toArray();
        }




        $penjualan_bulan_chart_convert = [];
        for ($i = 1; $i <= $total_days; $i++) {
            if (count($pemesanan_detail) > 0) {
                for ($j = 0; $j < count($pemesanan_detail); $j++) {
                    if ($i == (int) $pemesanan_detail[$j]['day_number']) {
                        $penjualan_bulan_chart_convert[$i] = (int) $pemesanan_detail[$j]['total_harga'];
                    } else {
                        if (!array_key_exists($i, $penjualan_bulan_chart_convert)) {
                            $penjualan_bulan_chart_convert[$i] = 0;
                        }
                    }
                }
            } else {
                $penjualan_bulan_chart_convert[$i] = 0;
            }
        }
        return response(['data' => $penjualan_bulan_chart_convert]);
    }

    public function reportAdmin(Request $request)
    {
        $user = auth()->user();
        $access = $user->access_type;
        $year = date('Y');
        $month = date('m');

        $total_years = 12;

        $ewarong = Ewarong::selectRaw('sum(DATE_FORMAT(created_at, "%m")) as month')
            ->groupBy('created_at')
            ->get()
            ->toArray();

        $pemesanan_ewarong = Ewarong::leftjoin('pemesanan', 'pemesanan.ewarong_id', '=', 'ewarong.id')
            ->selectRaw('ewarong.nama_kios, count(ewarong.nama_kios) as total')
            ->orderBy('total', 'desc')
            ->groupBy('ewarong.nama_kios')
            ->get()
            ->toArray();


        $count_mount = [];
        foreach ($ewarong as $key => $value) {
            if (array_key_exists((int) $value['month'], $count_mount)) {
                $count_mount[$value['month']] = $count_mount[$value['month']] + 1;
            } else {
                $count_mount[$value['month']] = 1;
            }
        }

        $penjualan_bulan_chart_convert = [];
        for ($i = 1; $i <= $total_years; $i++) {
            if (count($count_mount) > 0) {
                foreach ($count_mount as $key => $value) {
                    if ($i ==  $key) {
                        $penjualan_bulan_chart_convert[$i] = $value;
                        break;
                    } else {
                        $penjualan_bulan_chart_convert[$i] = 0;
                    }
                }
            } else {
                $penjualan_bulan_chart_convert[$i] = 0;
            }
        }
        return response(['data' => [
            'ewarongs' => $penjualan_bulan_chart_convert,
            'penjualan' => $pemesanan_ewarong
        ]]);
    }
}