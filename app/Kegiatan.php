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
        'foto_acara1',
        'foto_acara2',
        'foto_acara3',
        'okp_id',
    ];

    public function okp()
    {
        return $this->belongsTo('App\Okp');
    }
}