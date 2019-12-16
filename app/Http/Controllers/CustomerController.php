<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $customerList = Customer::all();    
        return view('customers.list',  ['user' => $user,'customerList' => $customerList]);
    }

    public function create()
    {
        $user = Auth::user();
        $customerList = Customer::all();    
        return view('customers.create',  ['user' => $user]);
    }

    public function store(Request $request)
    {

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
    }


    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }


    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
