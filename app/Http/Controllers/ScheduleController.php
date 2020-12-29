<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\Subject;
use App\Schedule;
use Illuminate\Http\Request;
use App\Exports\ScheduleExport;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{

    public function exportToCSV()
    {
        dd(12);
        return Excel::download(new ScheduleExport, 'schedules.xlsx');
    }

    public function index(Request $request)
    {
        $schedules = Schedule::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('backoffice.schedules.schedulesList', compact('schedules', 'success_message', 'alert_error'));
    }

    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $subjects = Subject::all();
        $schedules = Schedule::all();
        $teachers = User::where('type', 'guru')->get();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view(
            'backoffice.schedules.schedulesCreate',
            compact('schedules', 'kelas', 'subjects', 'teachers', 'success_message', 'error_message')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (strtotime($request->start_at) > strtotime($request->end_at)) {
                abort(403, 'Jam dimulai atau jam selesai ada yang salah. Jam dimulai ' . $request->start_at . ' Jam selesai '
                    . $request->end_at);
            }

            $check_schedule_kelas = Schedule::where('kelas_id', $request->kelas_id)
                ->where('day', $request->day)
                ->where('semester', $request->semester)
                ->where('year', $request->year)
                ->get();

            $check_schedule_teacher = Schedule::where('user_id', $request->user_id)
                ->where('day', $request->day)
                ->where('semester', $request->semester)
                ->where('year', $request->year)
                ->get();

            if ($check_schedule_kelas) {
                foreach ($check_schedule_kelas as $schedule) {
                    if (strtotime($request->start_at) < strtotime($schedule->start_at)) {
                        if (strtotime($request->end_at) < strtotime($schedule->start_at)) {
                            // dd('start at lebih kecil dan start end lebih kecil'); //next
                        } else {
                            abort(403, 'Jam pada jadwal yang anda buat sedang digunakan di kelas ini.');
                        }
                    } else {
                        if (strtotime($request->start_at) < strtotime($schedule->end_at)) {
                            abort(403, 'Jam pada jadwal yang anda buat sedang digunakan di kelas ini.');
                        } else {
                            // dd('start at lebih kecil dan start end lebih kecil'); //next
                        }
                    }
                }
            }

            if ($check_schedule_teacher) {
                foreach ($check_schedule_teacher as $schedule) {
                    if (strtotime($request->start_at) < strtotime($schedule->start_at)) {
                        if (strtotime($request->end_at) < strtotime($schedule->start_at)) {
                            // dd('start at lebih kecil dan start end lebih kecil'); //next
                        } else {
                            abort(403, 'Guru sudah mempunyai jadwal di jam yang anda setting');
                        }
                    } else {
                        if (strtotime($request->start_at) < strtotime($schedule->end_at)) {
                            abort(403, 'Guru sudah mempunyai jadwal di jam yang anda setting. Jam dimulai ');
                        } else {
                            // dd('start at lebih kecil dan start end lebih kecil'); //next
                        }
                    }
                }
            }

            Schedule::create($request->all());
            $request->session()->flash('alert-success', "Jadwa berhasil di buat!");
            return redirect('/schedule');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/schedule/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Schedule $schedule)
    {
        $kelas = Kelas::all();
        $subjects = Subject::all();
        $teachers = User::where('type', 'guru')->get();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view(
            'backoffice.schedules.schedulesUpdate',
            compact('schedule', 'kelas', 'subjects', 'teachers', 'success_message', 'error_message')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        try {
            $schedule->update([
                'kelas_id' => $request->kelas_id,
                'subject_id' => $request->subject_id,
                'user_id' => $request->user_id,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'day' => $request->day,
                'semester' => $request->semester,
                'year' => $request->year,
            ]);
            $request->session()->flash('alert-success', "Jadwal berhasil di update!");
            return redirect('/schedule');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/schedule');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Schedule $schedule)
    {
        try {
            $schedule->delete();
            $request->session()->flash('alert-success', "Jadwal berhasil di dihapus!");
            return redirect('/schedule');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/schedule');
        }
    }
}
