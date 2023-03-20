<?php

namespace Tests\Feature\Register;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /* @test */
    public function ok(): void
    {
        $this->get(to()->register->index())->assertOk();
    }
}
