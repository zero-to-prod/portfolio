<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class MailchimpProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ApiClient::class, function (Application $app) {
            return (new ApiClient())->setConfig([
                'apiKey' => $app['config']['mailchimp']['api_key'],
                'server' => $app['config']['mailchimp']['server'],
            ]);
        });
    }

    public function provides(): array
    {
        return [ApiClient::class];
    }
}
