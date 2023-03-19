<?php

namespace Tests\Feature\Register;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterIndexTest extends TestCase
{
    use RefreshDatabase;

    /* @test */
    public function ok(): void
    {
        $this->get(to()->web->register->index())->assertOk();
    }
}
