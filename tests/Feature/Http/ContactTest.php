<?php

namespace Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see To::contact()
     */
    public function ok(): void
    {
        $this->get(to()->contact())->assertOk();
    }
}
