<?php

namespace PartyGames\GameSubscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchases extends Model
{
    protected $table = 'subscription_purchases';

    protected $fillable = [
        'user_id',
        'subscription_package_id',
        'start_date',
        'end_date',
        'active',
        'payment_transaction_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'subscription_package_id' => 'integer',
        'payment_transaction_id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopePackage($query, $package_id)
    {
        return $query->where('subscription_package_id', $package_id);
    }
}