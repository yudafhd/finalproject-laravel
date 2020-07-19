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
    ];
    
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    protected $dates = ['deleted_at'];
}