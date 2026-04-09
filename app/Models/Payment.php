<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fee_id',
        'request_id',
        'payment_date',
        'amount_paid',
        'reference_number',
        'status',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function feeRate()
    {
        return $this->belongsTo(FeeRate::class, 'fee_id', 'fee_id');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'request_id');
    }
}
