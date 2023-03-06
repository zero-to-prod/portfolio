<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Testing\TestResponse;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->registerAssertRedirectHome();
        $this->registerAssertBadRequest();
        $this->registerAssertRedirectAs();

        return $app;
    }

    protected function registerAssertRedirectAs(): void
    {
        TestResponse::macro('assertRedirectAs', function ($uri) {
            if ($uri instanceof \UnitEnum) {
                $this->assertRedirect(route_as($uri));
            } else {
                $this->assertRedirect($uri);
            }

            return $this;
        });
    }

    protected function registerAssertRedirectHome(): void
    {
        TestResponse::macro('assertRedirectHome', function (string|null $query_string = null) {
            $this->assertRedirect(config('auth.home') . $query_string);

            return $this;
        });
    }

    protected function registerAssertBadRequest(): void
    {
        TestResponse::macro('assertBadRequest', function (string|null $query_string = null) {
            $this->assertStatus(400);

            return $this;
        });
    }
}
