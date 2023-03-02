<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Support\RouteMethods;

abstract class AuthTestCase extends BaseTestCase
{
    use CreatesApplication;
    use RouteMethods;

    protected function setUp(): void
    {
        parent::setUp();
        $this->be(User::factory()->create());
    }
}
