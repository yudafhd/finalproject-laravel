<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OkpReport extends Model
{

    protected $table = 'okps';

    protected $fillable = [
        'nama', 'bidang', 'alamat', 'long', 'lat', 'tanggal_daftar', 'no_okp', 'status', 'foto', 'visi', 'misi', 'latar_belakang', 'tanggal_berdiri', 'pendiri', 'user_id'
    ];

    protected $hidden = [
        'id',
        'foto',
        'user_id',
        'created_at',
        'updated_at'
    ];
}