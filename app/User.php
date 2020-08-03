<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'access_type',
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function general()
    {
        return $this->hasOne('App\General');
    }

    public function userPurchaseMap()
    {
        return $this->hasMany('App\UserPurchaseMap')
            ->orderBy('id', 'desc');
    }

    public function userPurchaseMapNotExpired()
    {
        return $this->hasMany('App\UserPurchaseMap')
            ->whereDate('expired_purchase_at', '>=', \Carbon\Carbon::today()->toDateString())
            ->orderBy('id', 'desc');
    }
}