<?php

namespace PartyGames\GameSubscriptions\Database\Seeders;

use Illuminate\Database\Seeder;
use PartyGames\GameSubscriptions\Models\SubscriptionPackages;

class AddSubscriptionPackages extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Basic',
                'description' => 'Basic package',
                'price' => 0,
                'duration' => 1,
                'duration_type' => 'month',
            ],
            [
                'name' => 'Game Beginner',
                'description' => 'Premium package',
                'price' => 395,
                'duration' => 1,
                'duration_type' => 'month',
            ],
            [
                'name' => 'Game Advanced',
                'description' => 'Premium package',
                'price' => 1295,
                'duration' => 1,
                'duration_type' => 'month',
            ],
            [
                'name' => 'Game Pro',
                'description' => 'Premium package',
                'price' => 5000, //in pences (GBP)
                'duration' => 1,
                'duration_type' => 'month',
            ],
            [
                'name' => 'Game Pro+',
                'description' => 'Yearly Game Pro With 15% Discount',
                'price' => 51000,
                'duration' => 12,
                'duration_type' => 'month',
            ],
        ];

        foreach ($packages as $package) {
            SubscriptionPackages::create($package);
        }
    }
}