<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens;

    protected $table = 'users';
    protected $guard_name = 'admin';

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
}
