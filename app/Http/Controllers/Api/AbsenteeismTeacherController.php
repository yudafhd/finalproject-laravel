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
                ->whereTime('end_at', '>=', date('H:i:s', $time))
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
                // 'absent_today' => $absent_today,
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
                        $userAbsentToday->reason = $request->reasons[$key];
                        $userAbsentToday->save();
                    } else {
                        Absent::create([
                            'schedule_id' => $request->schedule_id,
                            'user_id' => $value,
                            'reason' => $request->reasons[$key],
                            'date_absent' => $request->date_absent
                        ]);
                    }
                }
            }
            return response(['status' => 'success', 'message' => 'absent berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
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
