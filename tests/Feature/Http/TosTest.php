<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::tos()
     */
    public function ok(): void
    {
        $this->get(to()->tos())->assertOk();
    }
}
