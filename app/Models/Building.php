<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $primaryKey = 'building_id';
    public $timestamps = false;

    protected $fillable = [
        'building_code',
        'building_name',
    ];

    public function sectors()
    {
        return $this->hasMany(Sector::class, 'building_id', 'building_id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'building_id', 'building_id');
    }
}
