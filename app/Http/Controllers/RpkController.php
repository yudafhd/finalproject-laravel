<?php

namespace App\Http\Controllers;

use App\User;
use App\Rpk;
use Illuminate\Http\Request;

class RpkController extends Controller
{

    public function index(Request $request)
    {
        $rpks = Rpk::all();
        $success_message = $request->session()->get('alert-success');
        $alert_error = $request->session()->get('alert-error');
        return view('rpk.rpkList',  ['rpks' => $rpks, 'alert_error' => $alert_error, 'success_message' => $success_message]);
    }

    public function create(Request $request)
    {
        $users = User::all()->where('access_type', 'rpk');
        $error_message = $request->session()->get('alert-error');
        return view('rpk.rpkCreate',  ['users' => $users, 'error_message' => $error_message]);
    }

    public function store(Request $request)
    {
        $all_request =  $request->all();
        // $all_request['jam_buka'] = strtotime($request->jam_buka);
        try {
            $classes = Rpk::create($all_request);
            $classes->save();
            $request->session()->flash('alert-success', "Kios berhasil dibuat!");
            return redirect()->route('rpk.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('rpk.create');
        }
    }

    public function show(Rpk $rpk)
    {
        //
    }

    public function edit(Request $request, Rpk $rpk)
    {
        $users = User::all()->where('access_type', 'rpk');
        $error_message = $request->session()->get('alert-error');
        return view('rpk.rpkUpdate', ['rpk' => $rpk, 'users' => $users, 'error_message' => $error_message]);
    }


    public function update(Request $request, Rpk $rpk)
    {
        //
    }

    public function destroy(Rpk $rpk)
    {
        //
    }
}