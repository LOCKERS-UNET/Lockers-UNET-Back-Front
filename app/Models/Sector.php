<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $primaryKey = 'sector_id';
    public $timestamps = false;

    protected $fillable = [
        'building_id',
        'sector_name',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'building_id');
    }

    public function lockers()
    {
        return $this->hasMany(Locker::class, 'sector_id', 'sector_id');
    }
}
