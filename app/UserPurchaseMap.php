<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPurchaseMap extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'transaction_id',
        'expired_purchase_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}