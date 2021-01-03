<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absent;
use App\Schedule;
use App\User;
use App\Kelas;
use App\Exports\AbsentExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsentController extends Controller
{

    public function exportToCSV(Request $request)
    {
        return Excel::download(new AbsentExport($request->start_at, $request->end_at), 'report_absensi.xlsx');
    }

    public function index(Request $request)
    {
        $absents = Absent::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view(
            'backoffice.absents.absentsList',
            [
                'absents' => $absents,
                'alert_error' => $alert_error,
                'success_message' => $success_message
            ]
        );
    }

    public function create(Request $request)
    {

        $users = User::all()->where('type', 'siswa');
        $schedules = Schedule::all();
        $classes = Kelas::all();
        $error_message = $request->session()->get('alert-error');
        return view(
            'backoffice.absents.absentsCreate',
            ['users' => $users, 'request' => $request, 'classes' => $classes, 'schedules' => $schedules, 'error_message' => $error_message]
        );
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'schedule_id' => 'required',
                'date_absent' => 'required',
                'reason' => 'required',
            ]);

            foreach ($request->user_id as $user_val) {
                foreach ($request->schedule_id as $schedule_val) {
                    Absent::create([
                        'user_id' => $user_val,
                        'schedule_id' => $schedule_val,
                        'date_absent' => $request->date_absent,
                        'reason' => $request->reason,
                        'submit_from_admin' => 1,
                        'submit_from_parent' => 0,
                        'submit_from_teacher' => 0,
                        'description' => $request->description,
                        'status' => 1
                    ]);
                }
            }
            $request->session()->flash('alert-success', "Absen berhasil dibuat!");
            return redirect()->route('absent.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absent.create');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $absents = Absent::find($id);
        $users = User::all()->where('type', 'siswa');
        $schedules = Schedule::all();
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.absents.absentsUpdate', ['absents' => $absents, 'users' => $users, 'schedules' => $schedules, 'error_message' => $error_message]);
    }

    public function update(Request $request, $id)
    {
        try {
            $absents = Absent::find($id);
            $absents->user_id = $request->user_id;
            $absents->schedule_id = $request->schedule_id;
            $absents->date_absent = $request->date_absent;
            $absents->reason = $request->reason;
            $absents->description = $request->description;
            $absents->submit_from_admin = 1;
            $absents->submit_from_parent = 0;
            $absents->submit_from_teacher = 0;
            $absents->save();
            $request->session()->flash('alert-success', "Absen berhasil di perbarui!");
            return redirect()->route('absent.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absent.index');
        }
    }

    public function destroy(Request $request, Absent $absent)
    {
        try {
            $absent->delete();
            $request->session()->flash('alert-success', "Absen berhasil dihapus!");
            return redirect()->route('absent.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absent.index');
        }
    }
}
