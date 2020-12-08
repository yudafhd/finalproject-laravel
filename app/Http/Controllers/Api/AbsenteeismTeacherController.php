<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserItem;
use App\Schedule;
use App\Absent;
use App\User;

class AbsenteeismTeacherController extends Controller
{

    public function index(Request $request)
    {
        try {
            $day = $this->switchDayName($request->day);
            $time = strtotime($request->time);

            $absent_today = [];
            $absent_today = Absent::with(['user', 'schedule'])
                ->where('date_absent', date('Y-m-d', strtotime($request->date_absent)))
                ->get();

            $schedule_today = [];
            $schedule = Schedule::with(['kelas', 'subject'])
                ->where('user_id', auth()->user()->id)
                ->where('day', $day)
                ->where('start_at', '<=', date('H:i:s', $time))
                ->where('end_at', '>=', date('H:i:s', $time))
                ->get()->first();

            if ($schedule) {
                $schedule_today = $schedule;
            }

            $class_today = [];
            if ($schedule_today) {
                $users = User::where('kelas_id', '=', $schedule_today->kelas_id)->get();

                if (count($users) && count($absent_today)) {
                    foreach ($absent_today as $absent) {
                        foreach ($users as $student) {
                            if ($absent->user_id == $student->id && $absent->schedule_id == $schedule_today->id) {
                                $student->status = $absent->reason;
                            } else {
                                $student->status = "masuk";
                            }
                        }
                    }
                }

                if (count($users)) {
                    foreach ($users as $user) {
                        $class_today[] = new UserItem($user);
                    }
                }
            }

            return response(['data' => [
                'test' => date('H:i:s', $time),
                'schedule_today' => $schedule_today,
                'class_list' => $class_today
            ]]);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 500);
        }
    }

    public function submitAbsent(Request $request)
    {
        try {
            $userAbsentToday = [];

            if (count($request->user_id)) {
                foreach ($request->user_id as $key => $value) {
                    $userAbsentToday = Absent::where('date_absent', '=', $request->date_absent)
                        ->where('schedule_id', '=', $request->schedule_id)
                        ->where('user_id', '=', $value)->first();
                    if ($userAbsentToday) {
                        if ($request->reasons[$key] == 'masuk') {
                            $userAbsentToday->delete();
                        } else {
                            $userAbsentToday->reason = $request->reasons[$key];
                            $userAbsentToday->description = $request->descriptions[$key];
                            $userAbsentToday->save();
                        }
                    } else {
                        if ($request->reasons[$key] !== 'masuk') {

                            Absent::create([
                                'schedule_id' => $request->schedule_id,
                                'user_id' => $value,
                                'reason' => $request->reasons[$key],
                                'date_absent' => $request->date_absent,
                                'description' => $request->description
                            ]);

                            // Send notification
                            $userData = User::find($value);
                            $scheduleData = Schedule::find($request->schedule_id);
                            $this->sendNotification($userData, $scheduleData->subject->name);
                        }
                    }
                }
            }
            return response([
                'status' => 'success',
                'message' => 'absent berhasil ditambahkan',
            ]);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function sendNotification($user, $schedule_name)
    {

        $SERVER_API_KEY = env('FCM_ACCESS_KEY');

        $firebaseToken = array($user->notification_token);

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'PEMBERITAHUAN',
                "body" => 'Siswa A/N ' . $user->name .
                    ' tidak mengikuti pelajaran ' .
                    $schedule_name . ' hari ini',
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
    }

    public function switchDayName($name)
    {
        switch ($name) {
            case 'Sun':
                return "minggu";
                break;

            case 'Mon':
                return "senin";
                break;

            case 'Tue':
                return "selasa";
                break;

            case 'Wed':
                return "rabu";
                break;

            case 'Thu':
                return "kamis";
                break;

            case 'Fri':
                return "jumat";
                break;

            case 'Sat':
                return "sabtu";
                break;

            default:
                return "Tidak di ketahui";
                break;
        }
    }
}
