<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\BookingPackages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $booking = Booking::with('customer','bookingPackage')->get();
        $user = Auth::user(); 
        return view('booking.list',  ['user' => $user,'bookingList' => $booking]);
    }

    public function create()
    {
        $user = Auth::user();
        $customerList = Customer::all();
        $packageList = BookingPackages::all();
        return view('booking.create',  ['user' => $user,'customerList' => $customerList, 'packageList'=>$packageList]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $booking = new Booking;
        $booking->booking_date = $request->booking_date;
        $booking->start_time_at = $request->start_time_at;
        $booking->customer_id = $request->customer_id;
        $booking->booking_package_id = $request->booking_package_id;
        $booking->payment = $request->payment;
        $booking->admin_booking = $user->name;
        $booking->save();
        $request->session()->flash('alert-success', "Booking berhasil dibuat!");
        return redirect()->route('booking.index');
    }


    public function show($id)
    {
        $user = Auth::user();
        $bookingDetail = Booking::with('customer','bookingPackage')->where('id', $id)->get();
        return view('booking.detail',  ['user' => $user,'bookingDetail'=> $bookingDetail[0]]);
    }

    public function edit(Booking $booking)
    {
        $user = Auth::user();
        $customerList = Customer::all();
        $packageList = BookingPackages::all();
        return view('booking.edit',  ['user' => $user, 'booking'=> $booking,'customerList'=> $customerList,'packageList'=>$packageList]);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->booking_date = $request->booking_date;
        $booking->start_time_at = $request->start_time_at;
        $booking->customer_id = $request->customer_id;
        $booking->booking_package_id = $request->booking_package_id;
        $booking->payment = $request->payment;
        $booking->save();
        $request->session()->flash('alert-success', "Booking berhasil dibuat!");
        return redirect()->route('booking.index');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')
                        ->with('success','Booking deleted successfully');
    }

    // API LIST
    public function listbooking($date) {
        $bookingDetail = Booking::with('customer','bookingPackage')->where('booking_date', $date)->get();
        $filterData = count($bookingDetail) > 0 ? $bookingDetail : [];
        return response()->json($filterData, 200);
    }
}
