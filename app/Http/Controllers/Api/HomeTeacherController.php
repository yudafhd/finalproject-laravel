<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Absent;
use App\Schedule;

class HomeTeacherController extends Controller
{

    public function index(Request $request)
    {
        // $absent_today = Absent::with(['user', 'schedule'])->get();
        // $absent_today = Absent::with(['user', 'schedule'])->where('date_absent', date('Y-m-d', strtotime($request->date_absent)))->get();
        $absent_today20 = Absent::with(['user', 'schedule'])->where('date_absent', '2020-11-20')->get();
        $absent_today21 = Absent::with(['user', 'schedule'])->where('date_absent', '2020-11-21')->get();
        $absent_today22 = Absent::with(['user', 'schedule'])->where('date_absent', '2020-11-22')->get();
        $absent_today23 = Absent::with(['user', 'schedule'])->where('date_absent', '2020-11-23')->get();
        $absent_todaystr = Absent::with(['user', 'schedule'])->where('date_absent', date('Y-m-d', strtotime($request->date_absent)))->get();
        $schedule_today = Schedule::with(['kelas', 'subject'])->where('user_id', '=', auth()->user()->id)->get();
        return response(['data' => [
            // 'absents' => $absent_today,
            'absent_today20' => $absent_today20,
            'absent_today21' => $absent_today21,
            'absent_today22' => $absent_today22,
            'absent_today23' => $absent_today23,
            'absent_todaystr' => $absent_todaystr,
            'request-date_absent' => $request->date_absent,
            'schedules' => $schedule_today
        ]]);
    }
}
