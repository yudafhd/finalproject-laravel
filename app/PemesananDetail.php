<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    protected $table = 'pemesanan_detail';

    protected $fillable = [
        'qty',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function pemesanan()
    {
        return $this->belongsTo('App\Pemesanan');
    }
}