<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'rpk_id',
        'item_id',
        'qty',
        'harga',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public function rpk()
    {
        return $this->belongsTo('App\Ewarong');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}