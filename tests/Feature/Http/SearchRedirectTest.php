<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchRedirectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::welcome()
     */
    public function ok(): void
    {
        $this->post(to()->welcome())->assertOk();
    }
}
