<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $userList = [];
        $success_message = null;
        return view('backoffice.dashboard.index', compact('success_message', 'userList'));
    }
}