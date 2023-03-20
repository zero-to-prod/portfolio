<?php

namespace Register;

use App\Http\Controllers\Register\StoreRedirect;
use App\Models\User;
use Event;
use Exception;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Exception
     * @see \App\Http\Controllers\Register\StoreRedirect
     */
    public function register(): void
    {
        Notification::fake();
        Event::fake();
        $guest = user_f()->make();

        $response = $this->post(to()->register->store(), [
            StoreRedirect::name => $guest->name,
            StoreRedirect::email => $guest->email,
            StoreRedirect::password => $guest->password,
            StoreRedirect::password_confirmation => $guest->password,
        ]);

        /* Authentication */
        $this->assertAuthenticated();

        /* Database */
        $user = User::where(User::email, $guest->email)->first();
        self::assertNotNull($user);
        $this->assertEquals($guest->name, $user->name);
        $this->assertEquals($guest->email, $user->email);
        $this->assertTrue(Hash::check($guest->password, $user->password));

        /* Events */
        Event::assertDispatched(Registered::class, static function ($e) use ($user) {
            return $e->user->id === $user->id;
        });

        /* Notifications */
        Notification::assertSentToTimes($user, VerifyEmail::class);

          /* Redirect */
        $response->assertRedirect(StoreRedirect::redirectUrl());
    }
}
