<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'purchase_price',
        'purchase_subscription_period_number',
        'purchase_subscription_period_date',
        'expired_purchase_at',
        'order_id',
        'masked_card',
        'transaction_id',
        'status_message',
        'payment_type',
        'bank',
        'fraud_status',
        'transaction_time',
        'snap_token',
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