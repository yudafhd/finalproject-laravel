<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absents;
use App\Schedules;
use App\User;

class AbsentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $absents = Absents::all();
        $success_message = $request->session()->get('alert-success');
        return view('absents.absentsList',  ['absents' => $absents, 'success_message' => $success_message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $users = User::all()->where('type', 'siswa');
        $schedules = Schedules::all();
        $error_message = $request->session()->get('alert-error');
        return view('absents.absentsCreate', ['users' => $users, 'schedules' => $schedules, 'error_message' => $error_message]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $absents = Absents::find($id);
        $users = User::all()->where('type', 'siswa');
        $schedules = Schedules::all();
        $error_message = $request->session()->get('alert-error');
        return view('absents.absentsUpdate', ['absents' => $absents, 'users' => $users, 'schedules' => $schedules, 'error_message' => $error_message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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