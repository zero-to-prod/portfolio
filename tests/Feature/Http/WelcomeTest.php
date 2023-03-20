<?php

namespace Http;

use App\Helpers\Routing\WebRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see WebRoutes::welcome()
     */
    public function ok(): void
    {
        $this->get(to()->web->welcome())->assertOk();
    }
}
