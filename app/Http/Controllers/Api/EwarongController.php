<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Absents;
use App\Schedules;
use App\Subjects;
use App\Ewarong;
use App\Villages;
use App\Districts;
use App\Item;

class EwarongController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $semester = date('m', strtotime($request->date)) - 1 < 6 ? 'genap' : 'ganjil';
        $date = date('Y-m-d', $request->date);
        $year = date('Y', $request->date);
        $day = $this->switchDayName(date('D', $request->date));
        $hours = date('H:i:s', $request->date);

        $schedules_today = Schedules::with(['subject'])
            ->where('class_id', '=', $user->class_id)
            ->where('day', '=', $day)
            ->where('semester', '=', $semester)
            ->where('year', '=', $year)
            ->orderBy('start_at')
            ->get();

        $absent_today = Absents::where('date_absent', '=', $date)
            ->where('user_id', '=', $user->id)
            ->get();

        $schedule_ids = $absent_today->pluck(['schedule_id'])->toArray();

        foreach ($schedules_today as $value) {
            if (in_array($value->id, $schedule_ids)) {
                $value->absenteeism = $this->getReasonById($value->id, $absent_today);
            } else {
                if ($value->end_at <= $hours) {
                    $value->absenteeism = 'hadir';
                } else {
                    $value->absenteeism = 'belum terjadwal';
                }
            }
        }
        return response(['data' => [
            'schedules_absent_today' => $schedules_today,

        ]]);
    }

    public function allEwarong(Request $request)
    {
        $all_warong = Ewarong::with('pemesanan', 'stock', 'stock.item');
        $after = $all_warong->where('jam_buka', '<', $request->time)->get();
        return response(['data' => $after]);
    }

    public function allVillagesAndDistrics()
    {
        $districts = Districts::all()->whereIn('regency_id', [3576, 3516]);
        $districts_array = $districts->pluck('id');
        $villages = Villages::all()->whereIn('district_id', $districts_array);
        return response(['data' => [
            'districts' => $districts,
            'villages' => $villages
        ]]);
    }
    public function allItems()
    {
        $items = Item::all();
        return response(['data' => $items]);
    }
}