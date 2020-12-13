<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Schedule;

class UserKelasController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('kelas_id', $request->kelas_id)
            ->where('type', 'siswa')
            ->get();
        return response(['status' => 'success', 'data' => $user]);
    }
    public function schedule(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $day = $this->switchDayName(date('D', strtotime($request->date)));
        $scedule = Schedule::with(['subject', 'user'])
            ->where('kelas_id', $request->kelas_id)
            ->where('day', $day)
            ->orderBy('start_at')
            ->get();
        return response(['status' => 'success', 'data' => $scedule]);
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
