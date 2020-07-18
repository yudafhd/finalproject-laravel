<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function index(Request $request)
    {

        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;
        
        
        if($fraud) {
            error_log("Order ID ".$notif->order_id .": transaction status = ".$transaction.", fraud staus =".$fraud);

            if ($transaction == 'capture') {
                if ($fraud == 'challenge') {
                  // TODO Set payment status in merchant's database to 'challenge'
                }
                else if ($fraud == 'accept') {
                  // TODO Set payment status in merchant's database to 'success'
                }
            }
            else if ($transaction == 'cancel') {
                if ($fraud == 'challenge') {
                  // TODO Set payment status in merchant's database to 'failure'
                }
                else if ($fraud == 'accept') {
                  // TODO Set payment status in merchant's database to 'failure'
                }
            }
            else if ($transaction == 'deny') {
                  // TODO Set payment status in merchant's database to 'failure'
            }
            
        }

        
    }
}