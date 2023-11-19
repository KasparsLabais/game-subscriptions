<?php

namespace PartyGames\GameSubscriptions;

use Illuminate\Support\Facades\Auth;
class GameSubscriptions
{

    public static function getSubscriptionPackages()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscriptionPackages = $stripe->prices->all([
            'active' => true,
            'type' => 'recurring',
            'limit' => 5,
        ]);

        dd($subscriptionPackages);
    }

}