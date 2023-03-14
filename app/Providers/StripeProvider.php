<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class StripeProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StripeClient::class, function (Application $app) {
            return new StripeClient($app['config']['stripe']['key']);
        });
    }

    public function provides(): array
    {
        return [StripeClient::class];
    }
}
