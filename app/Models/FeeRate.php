<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeRate extends Model
{
    use HasFactory;

    protected $primaryKey = 'fee_id';
    public $timestamps = false; // Only has created_at physically defined in SQL

    protected $fillable = [
        'amount',
        'active_date',
        'status',
    ];

    protected $casts = [
        'active_date' => 'date',
        'amount' => 'decimal:2',
    ];
}
