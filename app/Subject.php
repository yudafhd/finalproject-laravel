<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    protected $hidden = [
         'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

}
