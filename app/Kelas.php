<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'majors',
        'grade',
        'number',
        'description',
    ];

    protected $hidden = [
         'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

}
