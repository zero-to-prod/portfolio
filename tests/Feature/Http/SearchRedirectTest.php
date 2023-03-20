<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchRedirectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::search()
     */
    public function ok(): void
    {
        $this->post(to()->search())->assertRedirect();
    }
}
