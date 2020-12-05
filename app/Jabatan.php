<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'nama',
        'okp_id',
    ];

    public function okp()
    {
        return $this->belongsTo('App\Okp');
    }
}
