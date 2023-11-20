<?php

namespace PartyGames\GameSubscriptions;

use Illuminate\Support\Facades\Auth;
use PartyGames\GameSubscriptions\Models\SubscriptionPackages;
use Stripe\Price;

class GameSubscriptions
{

    public static function getSubscriptionPackages()
    {
        /*
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscriptionPackages = $stripe->prices->all([
            'active' => true,
            'type' => 'recurring',
            'limit' => 5,
        ]);
        */

        return SubscriptionPackages::all();
        //dd($subscriptionPackages);
    }

    public static function createCheckoutSession($lookupKey)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $prices = $stripe->prices->all([
            'lookup_keys' => [$lookupKey],
            'expand' => ['data.product'],
        ]);
        $price = $prices->data[0];

        $session = $stripe->checkout->sessions->create([
            'success_url' => env('APP_URL') . '/premium/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL') . '/premium',
            'payment_method_types' => ['card'],
            'mode' => 'subscription',
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 1,
                ],
            ],
        ]);

        return $session->url;
    }

}