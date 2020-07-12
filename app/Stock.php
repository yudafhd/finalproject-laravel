<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stocks";
    protected $fillable = [
        'ewarong_id',
        'item_id',
        'satuan_id',
        'satuan_number',
        'qty',
        'harga',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public function ewarong()
    {
        return $this->belongsTo('App\Ewarong');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function satuan()
    {
        return $this->belongsTo('App\Satuan');
    }
}