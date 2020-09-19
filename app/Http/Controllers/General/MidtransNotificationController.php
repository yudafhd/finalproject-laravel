<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\UserPurchaseMap;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function test(Request $request)
    {
        // $transactionData = Transaction::where('order_id', 'MBRSHPDNT-XO1NH85')->firstOrFail();
        // if ($transactionData->product->type == 'subscription' &&
        //     $transactionData->purchase_subscription_period_date == 'day') {
        //     $start = new \Carbon\Carbon($transactionData->transaction_time);
        //     $expired_transaction = $start->addDays($transactionData->purchase_subscription_period_number)->format('Y-m-d h:m:s');
        //     $purchaseMap = UserPurchaseMap::whereTransaction_id($transactionData->id)->firstOrFail();
        //     $purchaseMap->expired_purchase_at = $expired_transaction;
        //     $purchaseMap->save();
        // }
    }

    public function index(Request $request)
    {
        $payload = $request->getContent();
        $paymentNotificationication = json_decode($payload);
        $validSignatureKey = hash(
            "sha512",
            $paymentNotificationication->order_id . $paymentNotificationication->status_code . $paymentNotificationication->gross_amount . config('services.midtrans.serverKey')
        );

        if ($paymentNotificationication->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $statusCode = null;

        try {
            $paymentNotification = new \Midtrans\Notification();
            $transactionData = Transaction::where('order_id', $paymentNotification->order_id)->firstOrFail();
            $transaction = $paymentNotification->transaction_status;
            $type = $paymentNotification->payment_type;
            $fraud = $paymentNotification->fraud_status;
            $status_message = $paymentNotification->status_message;
            $transaction_time = $paymentNotification->transaction_time; // 2020-07-19 01:32:51
            $transaction_id = $paymentNotification->transaction_id;
            $merchant_id = $paymentNotification->merchant_id;
            $gross_amount = $paymentNotification->gross_amount;
            $currency = $paymentNotification->currency;
            $signature_key = $paymentNotification->signature_key;
            $settlement_time = $paymentNotification->settlement_time; // 2020-07-19 01:32:51
            $vaNumber = null;
            $vendorName = null;
            if (!empty($paymentNotification->va_numbers[0])) {
                $vaNumber = $paymentNotification->va_numbers[0]->va_number;
                $vendorName = $paymentNotification->va_numbers[0]->bank;
            }

            // record data payment
            $transactionData->payment_type = $type;
            $transactionData->bank = $vendorName;
            $transactionData->fraud_status = $fraud;
            $transactionData->status_message = $status_message;
            $transactionData->transaction_time = $transaction_time;
            $transactionData->transaction_id = $transaction_id;
            $transactionData->record_json_response = $payload;

            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                $transactionData->status = 'challenge_fds';
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        $transactionData->status = 'success';
                    }
                }
            } elseif ($transaction == 'success') {

                if ($transactionData->product->type == 'subscription' &&
                    $transactionData->purchase_subscription_period_date == 'day') {
                    // Get transaction time
                    $start = new \Carbon\Carbon($transactionData->transaction_time);

                    // Calculating expired date
                    $expired_transaction = $start->addDays($transactionData->purchase_subscription_period_number)->format('Y-m-d h:m:s');

                    // Setting transaction
                    $purchaseMap = UserPurchaseMap::whereTransaction_id($transactionData->id)->firstOrFail();
                    $purchaseMap->expired_purchase_at = $expired_transaction;
                    $purchaseMap->save();
                }

                $transactionData->status = 'success';
            } elseif ($transaction == 'settlement') {

                if ($transactionData->product->type == 'subscription' &&
                    $transactionData->purchase_subscription_period_date == 'day') {
                    $start = new \Carbon\Carbon($transactionData->transaction_time);
                    $expired_transaction = $start->addDays($transactionData->purchase_subscription_period_number)->format('Y-m-d h:m:s');
                    $purchaseMap = UserPurchaseMap::whereTransaction_id($transactionData->id)->firstOrFail();
                    $purchaseMap->expired_purchase_at = $expired_transaction;
                    $purchaseMap->save();
                }

                $transactionData->status = 'settlement';
            } elseif ($transaction == 'pending') {
                $transactionData->status = 'pending';
            } elseif ($transaction == 'deny') {
                $transactionData->status = 'deny';
            } elseif ($transaction == 'expire') {
                $transactionData->status = 'expire';
            } elseif ($transaction == 'cancel') {
                $transactionData->status = 'cancel';
            }

            $transactionData->save();

            $response = [
                'code' => 200,
                'message' => 'update transaction succesfully',
            ];

            return response($response, 200);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 403);
        }
    }
}