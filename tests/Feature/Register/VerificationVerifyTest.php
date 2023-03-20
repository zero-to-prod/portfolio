<?php

namespace Register;

use App\Http\Controllers\Register\VerificationVerify;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class VerificationVerifyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see routes/web.php
     * @see \App\Http\Controllers\Register\VerificationVerify
     */
    public function email_can_be_verified(): void
    {
        $user = user_f()->unverified()->create();
        Event::fake();
        $parameters = ['id' => $user->id, 'hash' => sha1($user->email)];
        $url = temp_signed_route('verification.verify', 60, $parameters);

        $response = $this->actingAs($user)->get($url);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(VerificationVerify::redirectUrl());
    }

    /**
     * @test
     * @see routes/web.php
     * @see \App\Http\Controllers\Register\VerificationVerify
     */
    public function email_is_not_verified_with_invalid_hash(): void
    {
        $user = user_f()->unverified()->create();
        Event::fake();
        $parameters = ['id' => $user->id, 'hash' => sha1('wrong-email')];
        $url_from_wrong_email = temp_signed_route('verification.verify', 60, $parameters);

        $this->actingAs($user)->get($url_from_wrong_email);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    /**
     * @test
     * @see routes/web.php
     * @see \App\Http\Controllers\Register\VerificationVerify
     */
    public function verified_user_is_redirected_home(): void
    {
        $user = user();
        $parameters = ['id' => $user->id, 'hash' => sha1($user->email)];
        $url = temp_signed_route('verification.verify', 60, $parameters);

        $response = $this->actingAs($user)->get($url);

        $response->assertRedirect(to()->web->welcome());
    }
}
