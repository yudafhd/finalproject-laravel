<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'judul',
        'detail_kegiatan',
        'detail_anggaran',
        'tanggal_terlaksana',
        'sasaran',
        'tujuan',
        'hasil',
        'tempat',
        'foto',
        'okp_id',
    ];

    public function okp()
    {
        return $this->belongsTo('App\Okp');
    }
}