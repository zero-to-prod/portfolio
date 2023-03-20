<?php

namespace Register;

use App\Http\Controllers\Register\VerificationNotice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationNoticeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see \App\Http\Controllers\Register\VerificationNotice
     */
    public function ok(): void
    {
        $this->be(user_f()->unverified()->create());
        $this->get(to()->web->register->verification_notice())->assertOk();
    }

    /**
     * @test
     * @see \App\Http\Controllers\Register\VerificationNotice
     */
    public function does_not_access_when_verified(): void
    {
        $this->be(user());

        $this->get(to()->web->register->verification_notice())
            ->assertRedirect(VerificationNotice::redirectUrl());
    }

    /**
     * @test
     * @see \App\Http\Controllers\Register\VerificationNotice
     */
    public function does_not_access_when_not_logged_in(): void
    {
        $this->get(to()->web->register->verification_notice())->assertRedirect();
    }
}
