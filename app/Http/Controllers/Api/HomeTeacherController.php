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
        $absent_today = Absent::with(['user', 'schedule'])
            ->where('date_absent', date('Y-m-d', strtotime($request->date_absent)))
            ->get();

        // $schedule_today = Schedule::with(['kelas', 'subject'])
        //     ->where('user_id', '=', auth()->user()->id)
        //     ->get();

        $schedule_today = $this->orderByDay(Schedule::with(['kelas', 'subject'])
            ->where('user_id', '=', auth()->user()->id)
            ->get());

        return response(['data' => [
            'absents' => $absent_today,
            'schedules' => $schedule_today
        ]]);
    }

    public function orderByDay($data)
    {
        $result = [];
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

        foreach ($days as $key => $day) {
            foreach ($data as $val) {
                if ($day == $val->day) {
                    $result[$key] = $val;
                }
            }
        }
        return $result;
    }
}
