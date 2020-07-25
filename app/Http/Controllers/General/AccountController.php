<?php

namespace App\Http\Controllers\General;

use App\General;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $membershipName = null;
        $membership = auth()->user()->userPurchaseMapNotExpired()->first();
        if ($membership) {
            $membershipName = Product::findOrFail($membership->product_id)->name;
        }
        return view('general.account', compact('user', 'membership', 'membershipName'));
    }

    public function transaction(Request $request)
    {
        $user = auth()->user();
        $allTransaction = auth()->user()->userPurchaseMap()->get();
        return view('general.transaction', compact('user', 'allTransaction'));
    }

}