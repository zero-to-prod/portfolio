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

        return $app;
    }

    protected function registerAssertRedirectHome(): void
    {
        TestResponse::macro('assertRedirectHome', function (string|null $query_string = null) {
            $this->assertRedirect(config('auth.home') . $query_string);
            return $this;
        });
    }
}
