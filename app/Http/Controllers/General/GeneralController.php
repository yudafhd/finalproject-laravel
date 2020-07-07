<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        return view('general.index');
    }

    public function saveLinks(Request $request) {
        dd($request->all());
    }
}