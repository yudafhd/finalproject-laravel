<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function finish(Request $request)
    {
        $user = auth()->user();
        return view('general.orders.finish', compact( 'user'));
    }
    public function error(Request $request)
    {
        $user = auth()->user();
        return view('general.orders.error', compact( 'user'));
    }
}