<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'request_id',
        'space_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'request_id');
    }

    public function locker()
    {
        return $this->belongsTo(Locker::class, 'space_id', 'locker_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class, 'assignment_id', 'assignment_id');
    }
}
