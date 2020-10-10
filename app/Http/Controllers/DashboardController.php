<?php

namespace App\Http\Controllers;

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