<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{

    protected $fillable = [
        'nama',
        'jabatan',
        'tanggal_masuk',
        'alamat',
        'okp_id',
    ];

    public function okp()
    {
        return $this->belongsTo('App\Okp');
    }
}