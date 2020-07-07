<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('home', ['kegiatans' => $kegiatans]);
    }

    public function visi()
    {
        return view('visi');
    }

    public function contact()
    {
        return view('contact');
    }
}
