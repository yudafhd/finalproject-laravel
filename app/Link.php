<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'title', 'url', 'type', 'user_id', 'general_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['title', 'url', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}