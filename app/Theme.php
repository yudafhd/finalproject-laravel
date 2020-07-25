<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}