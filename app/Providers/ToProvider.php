<?php

namespace App\Providers;

use App\Helpers\Routing\To;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ToProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(To::class, fn() => new To);
    }

    public function provides(): array
    {
        return [To::class];
    }
}
