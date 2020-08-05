<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'admin';

    protected $redirectTo = '/backoffice';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth_admin.login');
    }

    public function guard()
    {
        return auth()->guard('admin');
    }

    public function login(Request $request)
    {
        try {
            $userChecker = Admin::where('username', $request->username)->first();
            if ($userChecker->access_type != 'general') {
                if (auth()->guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
                    return redirect()->route('admin.dashboard');
                }
            }
            return back()->withErrors(['username' => 'Email or password are wrong.']);
        } catch (\Exception $e) {
            return back()->withErrors(['username' => 'Email or password are wrong.']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('home');
    }
}