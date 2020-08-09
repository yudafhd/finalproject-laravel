<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'url', 'type', 'user_id', 'general_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}