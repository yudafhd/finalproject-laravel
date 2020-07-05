<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('general.home', ['username' => null]);
    }

    public function profile($username)
    {
        return view('general.profile', ['username' => $username]);
    }
}
