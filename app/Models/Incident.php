<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $primaryKey = 'incident_id';
    public $timestamps = false;

    protected $fillable = [
        'locker_id',
        'user_id',
        'description',
        'report_date',
        'status',
        'resolution',
    ];

    protected $casts = [
        'report_date' => 'datetime',
    ];

    public function locker()
    {
        return $this->belongsTo(Locker::class, 'locker_id', 'locker_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
