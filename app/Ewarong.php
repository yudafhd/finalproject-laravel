<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ewarong extends Model
{
    protected $table = 'ewarong';

    protected $fillable = [
        'user_id',
        'telp',
        'nama_kios',
        'latitude',
        'longitude',
        'jam_buka',
        'jam_tutup',
        'image_url',
        'lokasi',
        'village_id',
        'district_id',
        'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function pemesanan()
    {
        return $this->hasMany('App\Pemesanan');
    }
    public function stock()
    {
        return $this->hasMany('App\Stock');
    }
}