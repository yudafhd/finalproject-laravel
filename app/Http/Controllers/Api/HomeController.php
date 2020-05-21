<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HomeCollection;
use App\Absents;
use App\Schedules;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $absent_today = Absents::with(['user', 'schedule'])->where('date_absent', '=', $request->date_absent)->get();
        $schedule_today = Schedules::with(['class', 'subject'])->where('user_id', '=', auth()->user()->id)->get();
        return response(['data' => [
            'absents' => $absent_today,
            'schedules' => $schedule_today
        ]]);
    }
}