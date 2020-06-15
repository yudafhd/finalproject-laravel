<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'nomor_pemesanan',
        'user_id',
        'ewarong_id',
        'qty_total',
        'harga_total',
        'date_pemesanan',
        'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function ewarong()
    {
        return $this->belongsTo('App\Ewarong');
    }
    public function detail()
    {
        return $this->hasMany('App\PemesananDetail');
    }
}