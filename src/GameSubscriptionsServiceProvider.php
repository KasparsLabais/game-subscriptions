<?php

namespace PartyGames\GameSubscriptions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;

class GameSubscriptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->app->bind('game-subscriptions', function() {
            return new GameSubscriptions;
        });
    }
}