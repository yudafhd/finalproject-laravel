<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingPackages extends Model
{
    protected $table = 'booking_packages';
    protected $hidden = ['id'];
    protected $fillable = ['nama', 'price', 'description'];
}
