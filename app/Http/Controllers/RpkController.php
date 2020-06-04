<?php

namespace App\Http\Controllers;

use App\Rpk;
use Illuminate\Http\Request;

class RpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rpks = Rpk::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('rpk.rpkList',  ['rpks' => $rpks, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $error_message = $request->session()->get('alert-error');
        return view('rpk.rpkCreate',  ['error_message' => $error_message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rpk  $rpk
     * @return \Illuminate\Http\Response
     */
    public function show(Rpk $rpk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rpk  $rpk
     * @return \Illuminate\Http\Response
     */
    public function edit(Rpk $rpk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rpk  $rpk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rpk $rpk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rpk  $rpk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rpk $rpk)
    {
        //
    }
}