<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{

    public function index()
    {
        $booking = Booking::with('customer', 'bookingPackage')->where('status', 1)->get();
        $user = Auth::user();
        return view('pembayaran.list',  ['user' => $user, 'bookingList' => $booking]);
    }
}