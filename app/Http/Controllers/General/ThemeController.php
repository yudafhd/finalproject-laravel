<?php


namespace App\Http\Controllers\General;

use App\General;
use App\User;
use App\Link;
use App\Http\Controllers\Controller;
use App\Links;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $general_id = $user->general->id;
        $theme_id = $user->general->theme_id;
        $tweet = $user->general->tweet;
        $links = [];
        $message = $request->session()->get('alert');
        return view('general.theme', compact('tweet', 'links', 'user', 'message', 'theme_id'));
    }
}