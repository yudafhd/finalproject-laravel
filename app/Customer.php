<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Booking;

class Customer extends Model
{
    protected $table = 'customers';
    protected $hidden = ['id'];
    protected $fillable = ['nama', 'address', 'phone'];
}
