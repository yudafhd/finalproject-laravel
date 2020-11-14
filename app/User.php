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
        'user',
        'type',
        'dob',
        'address',
        'city',
        'short_info',
        'city',
        'nis',
        'nip',
        'kelas_id',
        'parent_name',
        'phone_number',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     static::deleting(function ($user) {
    //         $user->general()->delete();
    //         $user->links()->delete();
    //     });
    // }
}