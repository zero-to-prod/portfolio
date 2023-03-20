<?php

namespace Register;

use App\Http\Controllers\Auth\VerificationNotice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationNoticeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see VerificationNotice
     */
    public function ok(): void
    {
        $this->be(user_f()->unverified()->create());
        $this->get(to()->web->register->verification_notice())->assertOk();
    }

    /**
     * @test
     * @see VerificationNotice
     */
    public function does_not_access_when_verified(): void
    {
        $this->be(user());

        $this->get(to()->web->register->verification_notice())
            ->assertRedirect(VerificationNotice::redirectUrl());
    }

    /**
     * @test
     * @see VerificationNotice
     */
    public function does_not_access_when_not_logged_in(): void
    {
        $this->get(to()->web->register->verification_notice())->assertRedirect();
    }
}
