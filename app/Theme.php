<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'cover_colour',
        'cover_thumbnail',
        'theme_transaction',
        'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}