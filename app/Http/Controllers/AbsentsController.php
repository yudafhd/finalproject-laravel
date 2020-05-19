<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absents;
use App\Schedules;
use App\User;

class AbsentsController extends Controller
{

    public function index(Request $request)
    {
        $absents = Absents::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('absents.absentsList',  ['absents' => $absents, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {

        $users = User::all()->where('type', 'siswa');
        $schedules = Schedules::all();
        $error_message = $request->session()->get('alert-error');
        return view('absents.absentsCreate', ['users' => $users, 'schedules' => $schedules, 'error_message' => $error_message]);
    }

    public function store(Request $request)
    {

        try {

            $request->validate([
                'reason' => 'required',
                'user_id' => 'required',
                'schedule_id' => 'required',
                'date' => 'required',
            ]);

            $absents = new Absents;
            $absents->user_id = $request->user_id;
            $absents->schedule_id = $request->schedule_id;
            $absents->reason = $request->reason;
            $absents->date = $request->date;
            $absents->description = $request->description;
            $absents->save();

            $request->session()->flash('alert-success', "Absen berhasil dibuat!");
            return redirect()->route('absents.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absents.create');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $absents = Absents::find($id);
        $users = User::all()->where('type', 'siswa');
        $schedules = Schedules::all();
        $error_message = $request->session()->get('alert-error');
        return view('absents.absentsUpdate', ['absents' => $absents, 'users' => $users, 'schedules' => $schedules, 'error_message' => $error_message]);
    }

    public function update(Request $request, $id)
    {
        try {
            $absents = Absents::find($id);
            $absents->user_id = $request->user_id;
            $absents->schedule_id = $request->schedule_id;
            $absents->date = $request->date;
            $absents->reason = $request->reason;
            $absents->description = $request->description;
            $absents->save();
            $request->session()->flash('alert-success', "Absen berhasil di perbarui!");
            return redirect()->route('absents.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absents.index');
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            Absents::destroy($id);
            $request->session()->flash('alert-success', "Absen berhasil dihapus!");
            return redirect()->route('absents.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('absents.index');
        }
    }
}