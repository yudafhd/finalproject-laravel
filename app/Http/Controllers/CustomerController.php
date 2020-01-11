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
        return view('customers.create',  ['user' => $user]);
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->id_customer = $request->id_customer;
        $customer->save();
        $request->session()->flash('alert-success', "Customer {$request->name} berhasil dibuat!");
        return redirect('/customers');
    }


    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        $user = Auth::user();
        return view('customers.edit',  ['user' => $user, 'customer'=> $customer]);
    }


    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customers.index')
        ->with('success','Customers updated successfully');
    }

    public function destroy(Customer $customer)
    {
         $customer->delete();
  
        return redirect()->route('customers.index')
                        ->with('success','Customer deleted successfully');
    }
}
