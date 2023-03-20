<?php

namespace Register;

use App\Http\Controllers\Register\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoticeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     */
    public function ok(): void
    {
        $this->get(Store::redirectUrl())->assertOk();
    }

    /**
     * @test
     * @see routes/web.php
     */
    public function requires_signed_url(): void
    {
        $this->getAs(to()->register->notice())
            ->assertForbidden();
    }
}
