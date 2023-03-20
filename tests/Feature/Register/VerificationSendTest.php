<?php

namespace Register;

use App\Http\Controllers\Register\VerificationSend;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\TestCase;

class VerificationSendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see \App\Http\Controllers\Register\VerificationSend
     */
    public function verified_user_is_redirected(): void
    {
        $this->be(user());

        $this->post(to()->web->register->verification_send())
            ->assertRedirect(VerificationSend::redirectUrl());
    }

    /**
     * @test
     * @see VerificationSend
     */
    public function verification_email_send(): void
    {
        Notification::fake();
        $user = user_f()->unverified()->create();
        $this->be($user);

        $this->post(to()->web->register->verification_send())
            ->assertRedirect();

        Notification::assertSentToTimes($user, VerifyEmail::class);
    }
}
