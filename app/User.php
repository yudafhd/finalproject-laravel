<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_register',
        'address',
        'access_type',
        'image_url',
        'village_id',
        'district_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function class()
    {
        return $this->belongsTo('App\Classes');
    }
}