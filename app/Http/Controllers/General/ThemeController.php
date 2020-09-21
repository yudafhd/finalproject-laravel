<?php


namespace App\Http\Controllers\General;

use App\General;
use App\User;
use App\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $general_id = $user->general->id;
        $theme_id = $user->general->theme_id;
        $tweet = $user->general->tweet;
        $themes = Theme::all();
        $links = [];
        $message = $request->session()->get('alert');
        return view('general.theme', compact('tweet', 'links', 'user', 'message', 'theme_id', 'themes'));
    }

    public function themeUpdate(Request $request)
    {
        try {
            $general = General::whereUser_id(auth()->user()->id)->firstOrFail();
            $general->theme_id = $request->theme_id;
            $general->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect()->route('general.theme');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('general.theme');
        }
    }
}