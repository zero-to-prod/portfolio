<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::subscribe()
     */
    public function ok(): void
    {
        $this->get(to()->subscribe())->assertOk();
    }
}
