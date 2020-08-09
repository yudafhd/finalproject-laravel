<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $permissionInfo;

    // public function checkIsMembership()
    // {
    //     $userMapTransaction = auth()->user()->userPurchaseMaps;

    //     $justSubscription = [];
    //     foreach ($userMapTransaction as $key => $item) {
    //         if ($item->product->type == 'subscription') {
    //             $justSubscription[$key] = $item;
    //         }
    //     }
    // }

    public function checkPermissionAnd404($permission)
    {
        $this->permissionInfo = $permission;
        $this->middleware(function ($request, $next) {;
            if (auth()->user()->access_type !== 'superadmin') {
                if (!auth()->user()->can($this->permissionInfo)) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }
}