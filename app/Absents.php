<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absents extends Model
{
    protected $fillable = [
        'schedule_id',
        'user_id',
        'date_absent',
        'reason',
        'description',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function schedule()
    {
        return $this->belongsTo('App\Schedules');
    }
}