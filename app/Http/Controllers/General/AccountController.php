<?php


namespace App\Http\Controllers\General;

use App\General;
use App\User;
use App\Link;
use App\Http\Controllers\Controller;
use App\Links;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $general_id = $user->general->id;
        $theme_id = $user->general->theme_id;
        $tweet = $user->general->tweet;
        $links = [];
        $message = $request->session()->get('alert');
        return view('general.account', compact('tweet', 'links', 'user', 'message', 'theme_id'));
    }
    
    public function upgradeAccount(Request $request)
    {

        $user = auth()->user();
        $general_id = $user->general->id;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-UjjINZ5p1Kn7MYJAd-WMf4p3';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
  
        $transaction_details = array(
                'order_id' => strtoupper('MBRSHP-'. Str::random(5) . rand(0, date('mm'))),
                'gross_amount' => 5000,
        ); 

        $customer_details = array(
            'first_name'    => $user->name, 
            'email'         => $user->email, 
            'phone'         => $user->phone_number ? $user->phone_number : "081357778874", 
            );
        
        $item_details = array(
                'id' => '1',
                'price' => 5000,
                'quantity' => 1,
                'name' => "Member Donation"
        );

        $item_details = array ($item_details);
        
        // Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            );

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        
        $message = $request->session()->get('alert');
        return view('general.upgradeAccount', compact( 'user', 'message','snapToken'));
    }
}