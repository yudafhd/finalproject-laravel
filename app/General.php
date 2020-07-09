<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $fillable = [
        'membership', 'tweet', 'photo', 'user_id','theme_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}