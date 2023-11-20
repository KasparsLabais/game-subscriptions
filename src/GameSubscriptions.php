<?php

namespace PartyGames\GameSubscriptions;

use Illuminate\Support\Facades\Auth;
use PartyGames\GameSubscriptions\Models\PaymentTransactions;
use PartyGames\GameSubscriptions\Models\SubscriptionPackages;
use PartyGames\GameSubscriptions\Models\SubscriptionPurchases;
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

    public static function createCheckoutSession($lookupKey, $subscriptionId = null)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $prices = $stripe->prices->all([
            'lookup_keys' => [$lookupKey],
            'expand' => ['data.product'],
        ]);
        $price = $prices->data[0];

        $session = $stripe->checkout->sessions->create([
            'success_url' => 'https://is-a.gay/premium/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://is-a.gay/premium',
            'payment_method_types' => ['card'],
            'mode' => 'subscription',
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'user_id' => Auth::user()->id,
                'subscription_id' => $subscriptionId,
            ],
        ]);

        return $session->url;
    }


    public static function createTransaction($transactionObject, $userId)
    {
        $transaction = new PaymentTransactions();
        $transaction->payment_method = 'card';
        $transaction->payment_gateway = 'stripe';
        $transaction->payment_gateway_transaction_id = $transactionObject->id;
        $transaction->payment_gateway_status = $transactionObject->payment_status;
        $transaction->payment_gateway_error = '';
        $transaction->amount = $transactionObject->amount_total;
        $transaction->user_id = $userId;
        $transaction->save();

        return $transaction;
    }

    public static function createSubscriptionPurchase($transactions, $userId, $subscriptionId)
    {
        $subscription = new SubscriptionPurchases();
        $subscription->user_id = $userId;
        $subscription->subscription_package_id = $subscriptionId;
        $subscription->start_date = date('Y-m-d H:i:s');
        $subscription->end_date = date('Y-m-d H:i:s', strtotime('+1 month'));
        $subscription->active = true;
        $subscription->payment_transaction_id = $transactions->id;
        $subscription->save();

        return $subscription;
    }

    public static function getPremiumLevelFromSubscriptionId($subscriptionId)
    {
        $subscriptionPackage = SubscriptionPackages::find($subscriptionId);
        return $subscriptionPackage->premium_level;
    }
}