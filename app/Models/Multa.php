<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    //

    protected $fillable = [
        'monto',
        'descripcion',
        'user_id',
        'admin_id'
    ];

}
