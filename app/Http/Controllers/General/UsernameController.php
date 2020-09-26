<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Link;
use App\User;

class UsernameController extends Controller
{
    public function index($username)
    {
        $exception_uri = ['general', 'backoffice'];
        if (!in_array($username, $exception_uri)) {
            $user = User::with('general')->whereUsername($username)->firstOrFail();
            if (!$user) {
                abort(404);
            } else {
                $tweet = $user->general->tweet;
                $photo = $user->general->photo;
                $links = Link::where('user_id', $user->id)->get();
                return view('general.username', compact('photo', 'username', 'tweet', 'links'));
            }
        }
    }
}