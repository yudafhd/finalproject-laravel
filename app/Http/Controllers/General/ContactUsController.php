<?php


namespace App\Http\Controllers\General;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        $username = false;
        $user = auth()->user();
        return view('general_home.contactus', compact('username', 'user'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            ContactUs::create($request->all());
            DB::commit();
            $request->session()->flash('alert-success', "Pesan terkirim!");
            return redirect()->route('contactus');
        } catch (\Exception $e) {
            DB::rollback();
            $request->flash();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('contactus');
        }
    }
}
