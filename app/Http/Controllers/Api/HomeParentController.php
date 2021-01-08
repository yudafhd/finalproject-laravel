<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Absent;
use App\Schedule;
use App\Subject;

class HomeParentController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = auth()->user();
        $semester = date('m', $request->date) - 1 < 6 ? 'genap' : 'ganjil';
        $date = date('Y-m-d', $request->date);
        $year = date('Y', $request->date);
        $day = $this->switchDayName(date('D', $request->date));
        $hours = date('H:i:s', $request->date);

        $schedules_today = Schedule::with(['subject'])
            ->where('kelas_id', '=', $user->kelas_id)
            ->where('day', '=', $day)
            // ->where('semester', '=', $semester)
            ->where('year', '=', $year)
            ->orderBy('start_at')
            ->get();

        $absent_today = Absent::where('date_absent', '=', $date)
            ->where('user_id', '=', $user->id)
            ->get();

        $schedule_ids = $absent_today->pluck(['schedule_id'])->toArray();

        foreach ($schedules_today as $value) {
            if (in_array($value->id, $schedule_ids)) {
                $value->absenteeism = $this->getReasonById($value->id, $absent_today);
            } else {
                if ($value->end_at <= $hours) {
                    $value->absenteeism = 'hadir';
                }
                if ($value->start_at >= $hours) {
                    $value->absenteeism = 'belum di mulai';
                }
                if ($value->start_at <= $hours && $value->end_at >= $hours) {
                    $value->absenteeism = 'sedang berjalan';
                }
            }
        }

        return response(['data' => [
            'schedules_absent_today' => $schedules_today,
            'hours' => $semester

        ]]);
    }

    public function homeParentAllRecap(Request $request)
    {
        $user = auth()->user();
        $semester = $request->semester;
        $tahun = $request->year;
        $useDate = $request->useDate;
        $start_at = date('Y-m-d', strtotime($request->start_at));
        $end_at = date('Y-m-d', strtotime($request->end_at));
        $data = [];

        $all_recap = Absent::with(['user', 'schedule'])
            ->where('user_id', '=', $user->id)
            ->orderBy('date_absent', 'DESC');

        if ($useDate) {
            if ($start_at) {
                $all_recap->where('date_absent', '>=', $start_at);
                $all_recap->where('date_absent', '<=', $end_at);
                $temp = $all_recap->get();
                $data = $temp;
            } else {
                $data = $all_recap->get()->toArray();
            }
        } else {
            if ($semester) {
                $data_ganjil = [1, 2, 3, 4, 5, 6];
                if ($semester == 'genap') {
                    $data_ganjil = [7, 8, 9, 10, 11, 12];
                }
                $all_recap->whereYear('date_absent', $tahun);
                $temp = $all_recap->get();
                $data = $temp;
            } else {
                $data = $all_recap->get()->toArray();
            }
        }


        $subjects = Subject::all();
        $subject_ids = $subjects->pluck('id')->toArray();
        foreach ($data as $value) {
            $subject_id = $value->schedule->subject_id;
            if (in_array($value->schedule->subject_id, $subject_ids)) {
                $value->schedule->subject = $this->getSubjectById($subject_id, $subjects);
            }
        }
        $temp = [];
        if ($semester) {
            foreach ($data as $key => $val) {
                if ($semester == $val['schedule']['semester']) {
                    $temp[$key] = $val;
                }
            }
        } else {
            $temp = $data;
        }


        return response(['data' => [
            'all_recap' => $temp,
            'end_at' => $end_at,
            'start_at' => $start_at,
        ]]);
    }

    public function getSubjectById($id, $subjects)
    {
        foreach ($subjects as $value) {
            if ($value->id == $id) {
                return $value;
            }
        }
    }

    public function getReasonById($id, $absent_today)
    {
        foreach ($absent_today as $value) {
            if ($value->schedule_id == $id) {
                return $value->reason;
            }
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
