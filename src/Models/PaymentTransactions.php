<?php

namespace PartyGames\GameSubscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransactions extends Model
{
    protected $table = 'payment_transactions';

    protected $fillable = [
        'payment_method',
        'payment_gateway',
        'payment_gateway_transaction_id',
        'payment_gateway_status',
        'payment_gateway_error',
        'payment_gateway_error_code',
        'payment_gateway_error_message',
        'amount',
        'user_id'
    ];

    protected $casts = [
        'amount' => 'integer',
    ];
}