<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'majors', 'grade', 'number', 'description'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}