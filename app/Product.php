<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'SKU',
        'code',
        'type',
        'price',
        'description',
        'theme_id',
        'subscription_period_number',
        'subscription_period_date',
        'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function theme()
    {
        return $this->hasOne('App\Theme');
    }
}
