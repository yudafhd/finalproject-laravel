<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaExport extends Model
{

    protected $table = 'anggotas';
    
    protected $hidden = [
        'id',
        'foto',
        'okp_id',
        'created_at',
        'updated_at'
    ];
}