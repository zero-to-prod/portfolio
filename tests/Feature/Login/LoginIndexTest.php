<?php

namespace Tests\Feature\Login;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     */
    public function ok(): void
    {
        $this->get(to()->web->login->index())->assertOk();
    }
}
