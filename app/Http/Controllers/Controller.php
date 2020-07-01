<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Notifikasi;
use View;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // $all_notifikasi = Notifikasi::all();
        // $count_notifkasi = Notifikasi::all()->where('read', '=', 0);
        // View::share('notification_data', $all_notifikasi);
        // View::share('total_notifikasi', count($count_notifkasi));
    }
}