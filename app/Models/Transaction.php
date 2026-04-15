<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'loan_id',
        'user_id',
        'penalty_amount',
        'payment_method',
        'total_price',  
        'status',
        'paid_at',
        'paid_by'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'penalty_amount' => 'integer'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function paidBy()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}