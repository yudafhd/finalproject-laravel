<?php

namespace App\Http\Controllers;

use App\Schedules;
use App\Subjects;
use App\Classes;
use App\User;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{

    public function index(Request $request)
    {
        $schedules = Schedules::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('schedules.schedulesList',  ['schedules' => $schedules, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $subjects = Subjects::all();
        $classes = Classes::all();
        $teachers = User::all()->where('type', '==', 'guru');
        $error_message = $request->session()->get('alert-error');
        return view('schedules.schedulesCreate',  ['subjects' => $subjects, 'classes' => $classes, 'teachers' => $teachers, 'error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        try {
            $schedules = Schedules::create($request->all());
            $schedules->save();
            $request->session()->flash('alert-success', "Jadwal Pelajaran berhasil dibuat!");
            return redirect()->route('schedules.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('schedules.create');
        }
    }

    public function show(Schedules $schedules)
    {
        //
    }

    public function edit(Schedules $schedule, Request $request)
    {
        $subjects = Subjects::all();
        $classes = Classes::all();
        $teachers = User::all()->where('type', '==', 'guru');
        $error_message = $request->session()->get('alert-error');
        return view('schedules.schedulesUpdate', [
            'subjects' => $subjects,
            'classes' => $classes,
            'teachers' => $teachers,
            'schedule' => $schedule,
            'error_message' => $error_message
        ]);
    }

    public function update(Request $request, Schedules $schedule)
    {
        try {
            $schedule->class_id = $request->class_id;
            $schedule->subject_id = $request->subject_id;
            $schedule->user_id = $request->user_id;
            $schedule->start_at = $request->start_at;
            $schedule->end_at = $request->end_at;
            $schedule->day = $request->day;
            $schedule->semester = $request->semester;
            $schedule->year = $request->year;
            $schedule->save();
            $request->session()->flash('alert-success', "Jadwal Pelajaran berhasil di perbarui!");
            return redirect()->route('schedules.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('schedules.index');
        }
    }

    public function destroy(Schedules $schedule, Request $request)
    {
        try {
            $schedule->delete();
            $request->session()->flash('alert-success', "Jadwal Pelajaran berhasil dihapus!");
            return redirect()->route('schedules.index');
        } catch (\Exception $e) {
            $error_message = '';
            if (strpos('SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key', $e->getMessage()) === true) {
                $error_message = 'Kelas ini sedang di gunakan di modul lain, misal modul absensi, jadwal dll';
            } else {
                $error_message = $e->getMessage();
            }

            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('schedules.index');
        };
    }
}