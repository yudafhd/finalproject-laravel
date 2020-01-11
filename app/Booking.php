<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\BookingPackages;

class Booking extends Model
{
    protected $table = 'booking';
    protected $hidden = ['id'];
    protected $fillable = ['booking_date','customer_id', 'booking_package_id', 'payment', 'start_time_at','end_time_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bookingPackage()
    {
        return $this->belongsTo(BookingPackages::class);
    }

}
