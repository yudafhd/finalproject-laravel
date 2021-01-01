<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        return redirect('/user/siswa');
    }

    public function index()
    {

        return redirect('/user/siswa');
        $siswa = User::where('type', 'siswa')->get();
        $guru = User::where('type', 'guru')->get();
        $kelas = Kelas::all();
        $subject = Subject::all();
        return view('backoffice.dashboard.index', compact('siswa', 'guru', 'kelas', 'subject'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy()
    {
        //
    }
}
