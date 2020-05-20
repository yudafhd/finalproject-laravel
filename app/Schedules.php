<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{

    protected $fillable = [
        'class_id',
        'subject_id',
        'user_id',
        'start_at',
        'end_at',
        'day',
        'semester',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function class()
    {
        return $this->belongsTo('App\Classes');
    }
    public function subject()
    {
        return $this->belongsTo('App\Subjects');
    }
}