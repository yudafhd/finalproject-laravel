<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okp extends Model
{
    protected $fillable = [
        'nama', 'bidang', 'alamat', 'long', 'lat', 'tanggal_daftar', 'no_okp', 'status', 'foto', 'visi', 'misi', 'latar_belakang', 'tanggal_berdiri', 'pendiri', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Kegiatan');
    }

    public function anggota()
    {
        return $this->hasMany('App\Anggota');
    }
}