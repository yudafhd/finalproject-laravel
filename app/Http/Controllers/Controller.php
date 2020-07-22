<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

    }

    public function checkIsMembership()
    {
        $userMapTransaction = auth()->user()->userPurchaseMap;

        $justSubscription = [];
        foreach ($userMapTransaction as $key => $item) {
            if ($item->product->type == 'subscription') {
                $justSubscription[$key] = $item;
            }
        }
        dd($justSubscription);
    }
}