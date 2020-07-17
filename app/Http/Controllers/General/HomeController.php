<?php


namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
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
        $exception_uri = ['general','backoffice'];
        if(!in_array($username, $exception_uri)) {
            $user = User::with('general')->where('username', $username)->get()->first();
            if(!$user) {
                abort(404);
            }else{
                $tweet = $user->general->tweet;
                $links = Link::where('user_id', $user->id)->get();
                return view('general.username', ['username' => $username, 'tweet' => $tweet, 'links' => $links]);
            }

        }
    }
}