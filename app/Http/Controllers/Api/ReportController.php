<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PemesananDetail;

class ReportController extends Controller
{
    public function todayChartUser(Request $request)
    {
        $year = date('Y');
        $month = date('m');
        $pemesanan_detail = PemesananDetail::join('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
            ->whereMonth('pemesanan_detail.created_at',  $month)
            ->whereYear('pemesanan_detail.created_at', $year)
            ->selectRaw('sum(pemesanan_detail.harga) as total_harga, DATE_FORMAT(pemesanan.date_pemesanan, "%d") as day_number')
            ->groupBy('pemesanan.date_pemesanan')
            ->get()
            ->toArray();

        $total_days = 31;

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
}