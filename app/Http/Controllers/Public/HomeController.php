<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('public.home');
    }

}