<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FCMNotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        try {
            $SERVER_API_KEY = env('FCM_ACCESS_KEY');

            $firebaseToken = array($request->notification_token);

            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => 'PEMBERITAHUAN',
                    "body" => 'Siswa a/n ' . $request->name .
                        ' tidak mengikuti pelajaran ' .
                        $request->schedule_name . ' hari ini',
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch);

            return response([
                'status' => 'success',
                'message' => 'notif terkirim',
            ]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
