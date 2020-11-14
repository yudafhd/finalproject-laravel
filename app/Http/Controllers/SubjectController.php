<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.subjects.subjectsList', compact('subjects','success_message', 'error_message'));
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
        return view('backoffice.subjects.subjectsCreate', compact('success_message', 'error_message'));
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
            $code = [];
            if(!$request->code) {
                $code = [
                    'code' => strtolower(trim($request->name))
                ];
            }

            $subjectCreated = Subject::create(array_merge($request->all(), $code));
            $request->session()->flash('alert-success', "Mata Pelajaran {$subjectCreated->name} berhasil di buat!");
            return redirect('/subject');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/subject');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, Request $request)
    {
        $success_message = $request->session()->get('alert-success');
        $error_message = $request->session()->get('alert-error');
        return view('backoffice.subjects.subjectsUpdate', compact('subject','success_message', 'error_message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        try {
            $subjectUpdate = ['name' => $request->name];
            if($request->code) {
                array_merge($subjectUpdate, ['code'=> $request->code]);
            }
            $subject->update($subjectUpdate);
            $request->session()->flash('alert-success', "Mata Pelajaran {$subject->name} berhasil di update!");
            return redirect('/subject');
        } catch( \Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/subject');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Request $request)
    {
        try {
            $subject->delete();
            $request->session()->flash('alert-success', "{$subject->name} berhasil dihapus!");
            return redirect('/subject');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error',  $e->getMessage());
            return redirect('/subject/');
        }
    }
}
