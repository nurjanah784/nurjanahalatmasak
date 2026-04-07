<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'amount',
        'borrow_date',
        'return_date',
        'description',
        'status',
        'condition',
        'penalty_amount',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'datetime',
        'penalty_amount' => 'integer'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}