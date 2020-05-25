<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserItem;
use App\Schedules;
use App\Absents;
use App\User;

class AbsenteeismTeacherController extends Controller
{

    public function index(Request $request)
    {
        try {
            $hours = date('h:i:s', strtotime($request->hours));
            $day = $this->switchDayName(date('D', strtotime($request->date)));
            $schedule_today = Schedules::with(['class', 'subject'])
                ->where('day', '=', $day)
                ->whereTime('start_at', '<=', $hours)
                ->whereTime('end_at', '>=', $hours)
                ->get();

            $class_today = [];
            foreach ($schedule_today as $key => $value) {
                $users = User::where('class_id', '=', $value->class_id)->get();
                if (count($users)) {
                    foreach ($users as $user) {
                        $class_today[$key][] = new UserItem($user);
                    }
                }
            }
            return response(['data' => [
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
            $absent = [];
            if (count($request->user_id)) {
                foreach ($request->user_id as $key => $value) {
                    $absent = Absents::where('date_absent', '=', $request->date_absent)
                        ->where('schedule_id', '=', $request->schedule_id)
                        ->where('user_id', '=', $value)
                        ->get();
                    if (count($absent)) {
                        foreach ($absent as $absent_index) {
                            $absent_index->reason = $request->reasons[$key];
                            $absent_index->description = $request->descriptions[$key];
                            $absent_index->save();
                        }
                    } else {
                        $absent = Absents::create([
                            'schedule_id' => $request->schedule_id,
                            'user_id' => $value,
                            'reason' => $request->reasons[$key],
                            'description' => $request->descriptions[$key],
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