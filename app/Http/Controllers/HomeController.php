<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use App\Okp;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('home', ['kegiatans' => $kegiatans]);
    }
    public function detail($id)
    {
        $kegiatans = Kegiatan::findOrFail($id);
        return view('detail', ['kegiatans' => $kegiatans]);
    }

    public function visi()
    {
        return view('visi');
    }

    public function contact()
    {
        return view('contact');
    }

    public function daftarOkp()
    {
        $okps = Okp::all();
        return view('daftar-okp', ['okps' => $okps]);
    }

    public function detailOkp($id)
    {
        $okp = Okp::findOrFail($id);
        $kegiatans = Kegiatan::where(['okp_id' => $id])->get();
        return view('detail-okp', ['okp' => $okp, 'kegiatans' => $kegiatans]);
    }
}