<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{

    public function index(Request $request)
    {
        $classes = Classes::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('classes.classesList',  ['classes' => $classes, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('classes.classesCreate',  ['error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        try {
            $classes = Classes::create($request->all());
            $classes->save();
            $request->session()->flash('alert-success', "Kelas berhasil dibuat!");
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('classes.create');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Classes $class, Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('classes.classesUpdate', ['class' => $class, 'error_message' => $error_message]);
    }

    public function update(Classes $class, Request $request)
    {
        try {
            $class->majors = $request->majors;
            $class->grade = $request->grade;
            $class->number = $request->number;
            $class->save();
            $request->session()->flash('alert-success', "Kelas berhasil di perbarui!");
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('classes.index');
        }
    }

    public function destroy(Classes $class, Request $request)
    {
        try {
            $class->delete();
            $request->session()->flash('alert-success', "Kelas berhasil dihapus!");
            return redirect()->route('classes.index');
        } catch (\Exception $e) {

            $error_message = '';
            if (strpos('SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key', $e->getMessage()) === true) {
                $error_message = 'Kelas ini sedang di gunakan di modul lain, misal modul absensi, jadwal dll';
            } else {
                $error_message = $e->getMessage();
            }

            $request->session()->flash('alert-error', $error_message);
            return redirect()->route('classes.index');
        }
    }
}