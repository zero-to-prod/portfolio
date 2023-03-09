<?php

namespace Tests\Feature\Macros\App;

use App;
use App\Helpers\Environments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnvironmentAsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @see AppServiceProvider::registerEnvironmentAs()
     */
    public function environmentAs(): void
    {
        self::assertTrue(App::environmentAs(Environments::testing));
        self::assertFalse(App::environmentAs(Environments::production));
        self::assertTrue(App::environmentAs(Environments::testing->value, 'bogus'));

    }

    /**
     * @test
     *
     * @see AppServiceProvider::registerEnvironmentAs()
     */
    public function default_behavior(): void
    {
        self::assertTrue(App::environment(Environments::testing->value));
        self::assertFalse(App::environment(Environments::production->value));
        self::assertTrue(App::environment(Environments::testing->value, 'bogus'));
    }
}
