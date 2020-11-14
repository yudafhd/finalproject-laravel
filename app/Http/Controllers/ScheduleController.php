<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Subject;
use App\Kelas;
use App\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = Schedule::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('backoffice.schedules.schedulesList', compact('schedules','success_message', 'alert_error'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $subjects = Subject::all();
        $schedules = Schedule::all();
        $teachers = User::where('type', 'guru')->get();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.schedules.schedulesCreate', 
        compact('schedules','kelas','subjects','teachers','success_message', 'error_message'));
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
            Schedule::create($request->all());
            $request->session()->flash('alert-success', "Jadwa berhasil di buat!");
            return redirect('/schedule');
        }catch(\Exception $e) {
            $request->session()->flash('alert-success', $e->getMessage());
            return redirect('/schedule');
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
    public function edit( Request $request, Schedule $schedule)
    {
        $kelas = Kelas::all();
        $subjects = Subject::all();
        $teachers = User::where('type', 'guru')->get();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.schedules.schedulesUpdate', 
        compact('schedule','kelas','subjects','teachers','success_message', 'error_message'));
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
        } catch( \Exception $e) {
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
