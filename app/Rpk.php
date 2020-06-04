<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpk extends Model
{
    protected $table = 'rpk';

    protected $fillable = [
        'class_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
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