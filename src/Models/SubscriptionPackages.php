<?php

namespace PartyGames\GameSubscriptions\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPackages extends Model
{
    protected $table = 'subscription_packages';

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'duration_type',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}