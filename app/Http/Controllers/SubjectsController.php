<?php

namespace App\Http\Controllers;

use App\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{

    public function index(Request $request)
    {
        $subjects = Subjects::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('subjects.subjectsList',  ['subjects' => $subjects, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('subjects.subjectsCreate',  ['error_message' => $error_message]);
    }


    public function store(Request $request)
    {
        try {
            $subjects = Subjects::create(['name' => $request->name]);
            if ($request->code) {
                $subjects->code = $request->code;
            } else {
                $codefilter = str_replace(' ', '', $request->name);
                $subjects->code = strtolower($codefilter);
            }
            $subjects->save();
            $request->session()->flash('alert-success', "Mata Pelajaran berhasil dibuat!");
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('subjects.create');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Subjects $subject, Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('subjects.subjectsUpdate', ['subject' => $subject, 'error_message' => $error_message]);
    }

    public function update(Subjects $subject, Request $request)
    {
        try {
            $subject->name = $request->name;
            if ($request->code) {
                $subject->code = $request->code;
            } else {
                $codefilter = str_replace(' ', '', $request->name);
                $subject->code = strtolower($codefilter);
            }
            $subject->save();
            $request->session()->flash('alert-success', "Mata Pelajaran berhasil di perbarui!");
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('subjects.index');
        }
    }

    public function destroy(Subjects $subject, Request $request)
    {
        try {
            $subject->delete();
            $request->session()->flash('alert-success', "Mata Pelajaran berhasil dihapus!");
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            $error_message = '';
            if (strpos('SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key', $e->getMessage()) === true) {
                $error_message = 'Kelas ini sedang di gunakan di modul lain, misal modul absensi, jadwal dll';
            } else {
                $error_message = $e->getMessage();
            }

            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('subjects.index');
        };
    }
}