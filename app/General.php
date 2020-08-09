<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'membership', 'tweet', 'photo', 'user_id', 'theme_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}