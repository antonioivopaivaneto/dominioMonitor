<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'stripe_payment_id',
        'stripe_customer_id',
        'amount',
        'currency',
        'status',
        'paid_at'
    ];

    protected $dates = ['paid_at'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function subscription():BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
