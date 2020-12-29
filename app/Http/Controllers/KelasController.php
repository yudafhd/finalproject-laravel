<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Exports\KelasExport;
use App\Imports\KelasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{

    public function exportToCSV()
    {
        return Excel::download(new KelasExport, 'kelas.xlsx');
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file_excel;
            Excel::import(new KelasImport, $file);
            $request->session()->flash('alert-success', "Kelas berhasil di import!");
            return redirect('/kelas');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/kelas');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Kelas::all();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.classes.classesList', compact('classes', 'success_message', 'error_message'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.classes.classesCreate', compact('success_message', 'error_message'));
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
            $kelas = Kelas::create($request->all());
            $request->session()->flash('alert-success', "Kelas {$kelas->majors} {$kelas->grade} {$kelas->number} berhasil di buat!");
            return redirect('/kelas');
        } catch (\Exception $e) {
            $request->session()->flash('alert-success', $e->getMessage());
            return redirect('/kelas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela, Request $request)
    {
        $kelas = $kela;
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.classes.classesUpdate', compact('kelas', 'error_message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        try {
            $kela->update([
                'majors' => $request->majors,
                'grade' => $request->grade,
                'number' => $request->number
            ]);
            $request->session()->flash('alert-success', "Kelas  {$kela->grade} {$kela->majors} {$kela->number} berhasil di update!");
            return redirect('/kelas');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Kelas $kela)
    {
        try {
            $kela->delete();
            $request->session()->flash('alert-success', "Kelas  {$kela->grade} {$kela->majors} {$kela->number} berhasil di dihapus!");
            return redirect('/kelas');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/kelas');
        }
    }
}
