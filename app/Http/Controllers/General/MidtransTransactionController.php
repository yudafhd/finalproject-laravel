<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Product;
use App\Transaction;

class MidtransTransactionController extends Controller
{
    public function upgradeAccount(Request $request)
    {
        try {\Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            \Midtrans\Config::$isSanitized =  config('services.midtrans.isSanitized');
            \Midtrans\Config::$is3ds =  config('services.midtrans.is3ds');
      
            $user = auth()->user();
            $general_id = $user->general->id;
            $product = Product::where('code', 'MBRSHPDNT')->get()->first();
            $carbon = new Carbon();
            $date_now = $carbon->format('Y-m-d H:i')." +0700";
            $snapToken = null;
            $transaction_id = null;
            $order_id_data = null;
            $status = null;
            $purchase_price = null;
            $currentTransaction = Transaction::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get()
            ->first();
            
            if($currentTransaction) {
                $snapToken = $currentTransaction->snap_token;
                $order_id_data = $currentTransaction->order_id;
                $purchase_price = $currentTransaction->purchase_price;
                $status = $currentTransaction->status;
            }else {
                $order_id =  strtoupper('MBRSHP-'. Str::random(5) . rand(0, date('mm')));
                $transaction_details = array(
                        'order_id' => $order_id,
                        'gross_amount' =>  $product->price,
                ); 
        
                $customer_details = array(
                    'first_name'    => $user->name, 
                    'email'         => $user->email, 
                    'phone'         => $user->phone_number ? $user->phone_number : "081357778874", 
                    );
        
                $expiry = array(
                    "unit" => "hours",
                    "duration" => 1
                );
        
                $item_details = array(
                        'id' =>  $product->SKU,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1,
                );
        
                $item_details = array ($item_details);
                
                // Fill transaction details
                $transaction = array(
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $item_details,
                    'expiry' => $expiry,
                    );
        
                $snapToken = \Midtrans\Snap::getSnapToken($transaction);
                
                //Create transaction
                Transaction::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'purchase_price' => $product->price,
                    'purchase_subscription_period_number' => $product->subscription_period_number,
                    'purchase_subscription_period_date' => $product->subscription_period_date,
                    'order_id' => $order_id ,
                    'snap_token' => $snapToken ,
                    'status' => "pending",
                ]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $message = $request->session()->get('alert');
        return view('general.upgradeAccount', 
            compact( 'user', 'message','snapToken','purchase_price','order_id_data','transaction_id','status'));
    }
    
    public function upgradeAccountViews(Request $request)
    {

        $user = auth()->user();
        $general_id = $user->general->id;
        $snapToken = null;
        $message = $request->session()->get('alert');
        return view('general.upgradeAccount', compact( 'user', 'message','snapToken'));
    }
}