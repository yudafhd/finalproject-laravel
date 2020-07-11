<?php

namespace App\Http\Controllers;

use App\User;
use App\Ewarong;
use App\Pemesanan;
use App\PemesananDetail;
use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ewarong_total = count(Ewarong::where('status', 'ACTIVE')->get());
        $user_total = count(User::where('access_type', 'umum')->get());
        $items_total = count(Item::all());
        $popular_items =   DB::table('items')
        ->leftJoin('pemesanan_detail', 'pemesanan_detail.item_id', '=', 'items.id')
        ->leftJoin('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
        ->selectRaw('sum(pemesanan_detail.qty) as total_terjual, items.nama, items.deskripsi')
        ->groupBy(['items.id', 'items.nama', 'items.deskripsi'])
        ->where('pemesanan.status', '!=', 'REJECTED')
        ->orderBy('total_terjual', 'DESC')
        ->get();
    if(auth()->user()->access_type == 'rpk') {
        $order_total = count(Pemesanan::where('status', '!=', 'REJECTED')->where('ewarong_id', auth()->user()->ewarong->id)->get());
        $penjualan_bulan_ini =  PemesananDetail::leftjoin('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
        ->where('pemesanan.status', '=', 'FINISH')
        ->whereMonth('pemesanan.created_at', date('m'))
        ->where('pemesanan.ewarong_id', auth()->user()->ewarong->id)
        ->get()
        ->pluck('harga');
        
        $penjualan_bulan_chart =  PemesananDetail::join('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
        ->where('pemesanan.status', '=', 'FINISH')
        ->whereMonth('pemesanan.created_at', date('m'))
        ->where('pemesanan.ewarong_id', auth()->user()->ewarong->id)
        ->selectRaw('sum(pemesanan_detail.harga) as total_harga, DATE_FORMAT(pemesanan.date_pemesanan, "%d") as day_number')
        ->groupBy('pemesanan.date_pemesanan')
        ->get()
        ->toArray();
    }else {
        $order_total = count(Pemesanan::where('status', '!=', 'REJECTED')->get());
        $penjualan_bulan_ini =  PemesananDetail::leftjoin('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
            ->where('pemesanan.status', '=', 'FINISH')
            ->whereMonth('pemesanan.created_at', date('m'))
            ->get()
            ->pluck('harga');

        $penjualan_bulan_chart =  PemesananDetail::join('pemesanan', 'pemesanan.id', '=', 'pemesanan_detail.pemesanan_id')
            ->where('pemesanan.status', '=', 'FINISH')
            ->whereMonth('pemesanan.created_at', date('m'))
            ->selectRaw('sum(pemesanan_detail.harga) as total_harga, DATE_FORMAT(pemesanan.date_pemesanan, "%d") as day_number')
            ->groupBy('pemesanan.date_pemesanan')
            ->get()
            ->toArray();
    }
            $penjualan_bulan_ini_total = 0;
            foreach ($penjualan_bulan_ini as $penjualan_bulan_ini) {
                $penjualan_bulan_ini_total = $penjualan_bulan_ini_total + (int) $penjualan_bulan_ini;
            }
           
        $total_days = 31;

        $penjualan_bulan_chart_convert = [];
        for ($i = 1; $i <= $total_days; $i++) {
            for ($j = 0; $j < count($penjualan_bulan_chart); $j++) {
                if ($i == (int) $penjualan_bulan_chart[$j]['day_number']) {
                    $penjualan_bulan_chart_convert[$i] = (int) $penjualan_bulan_chart[$j]['total_harga'];
                } else {
                    if (!array_key_exists($i, $penjualan_bulan_chart_convert)) {
                        $penjualan_bulan_chart_convert[$i] = 0;
                    }
                }
            }
        };


        return view('dashboard', compact(
            'user_total',
            'ewarong_total',
            'order_total',
            'items_total',
            'popular_items',
            'penjualan_bulan_ini_total',
            'total_days',
            'penjualan_bulan_chart_convert'
        ));
    }
}