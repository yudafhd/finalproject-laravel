<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationTokenController extends Controller
{
    public function index(Request $request)
    {
        // $token = $request->notification_token;

        try {

            $SERVER_API_KEY = "AAAAeIMhUG4:APA91bFTAfdUqrZebkyepeIZKldIqg6oWXbErrILHF6p1xHp9oKtN-pq0T7SbvIt6taWP2SpI8Xx2Em5-PikfxoLi0S2s5RALKGcrS4HKwjQMY66XUE5WAg9hzAJlyvCpXPcdSU4HEC7";

            $firebaseToken = array("fGD_XasmSO-yNapT05h8Gc:APA91bF_RsmFIUckdo4E225fMwSPAOxUlHOqbN_KDSoII_vI-ffy3SDYsHvqxOfEXOhIF0A9tlJx1b_Si2owEe44VeJ8hox2RJIwiwVW1Sf1rIz_ZVoDAOSF0BfFzwHs7p9GMj0blIME");

            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => 'Halo from postman',
                    "body" => 'siap',
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

            $response = curl_exec($ch);

            // $user = User::find(auth()->user()->id);
            // $user->notification_token = $token;
            // $user->save();

            // return response(['status' => 'success', 'message' => 'Token FCM berhasil ditambahkan']);
            return response(['status' => 'success', 'message' => $response]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}
