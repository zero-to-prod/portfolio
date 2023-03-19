<?php

namespace Register;

use App\Http\Controllers\RegisterStoreRedirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNoticeViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     */
    public function ok(): void
    {
        $this->get(RegisterStoreRedirect::redirectUrl())->assertOk();
    }

    /**
     * @test
     * @see routes/web.php
     */
    public function requires_signed_url(): void
    {
        $this->getAs(to()->web->register->notice())
            ->assertForbidden();
    }
}
