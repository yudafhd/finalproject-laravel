<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanExport extends Model
{

    protected $table = 'kegiatans';

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
    
    protected $hidden = [
        'id',
        'foto',
        'okp_id',
        'created_at',
        'updated_at'
    ];
}