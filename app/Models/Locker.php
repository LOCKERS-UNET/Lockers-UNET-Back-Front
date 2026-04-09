<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;

    protected $primaryKey = 'locker_id';

    protected $fillable = [
        'sector_id',
        'locker_number',
        'status',
        'observations',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'sector_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'space_id', 'locker_id');
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'locker_id', 'locker_id');
    }
}
