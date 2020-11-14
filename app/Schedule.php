<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kelas_id',
        'subject_id',
        'user_id',
        'start_at',
        'end_at',
        'day',
        'semester',
        'year',
    ];

    protected $hidden = [
         'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
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
