<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MidtransTransactionController extends Controller
{
    public function upgradeAccount(Request $request)
    {

        $user = auth()->user();
        $general_id = $user->general->id;


        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized =  config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds =  config('services.midtrans.is3ds');
  
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