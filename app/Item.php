<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = [
        'nama',
        'deskripsi',
        'qty',
        'harga',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}