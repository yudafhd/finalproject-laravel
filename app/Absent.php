<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'reason',
        'image',
        'date_absent',
        'description'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
