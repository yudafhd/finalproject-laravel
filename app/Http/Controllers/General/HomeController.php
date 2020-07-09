<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Link;
class HomeController extends Controller
{
    public function index()
    {
        return view('general.home', ['username' => '']);
    }

    public function usernameProfile($username)
    {
        $user = User::with('generals')->where('username', $username)->get()->first();
        $tweet = $user->generals['tweet'];
        $links = Link::where('user_id', $user->id)->get();
        return view('general.username', ['username' => $username, 'tweet' => $tweet, 'links' => $links]);
    }
}