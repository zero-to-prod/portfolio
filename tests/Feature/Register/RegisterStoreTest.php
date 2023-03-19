<?php

namespace Register;

use App\Http\Controllers\RegisterStoreRedirect;
use App\Models\User;
use Event;
use Exception;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\TestCase;

class RegisterStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Exception
     * @see RegisterStoreRedirect
     */
    public function register(): void
    {
        Notification::fake();
        Event::fake();
        $guest = User::make([
            User::name => 'guest',
            User::email => 'email@gmail.com',
            User::password => '123456789',
        ]);

        $response = $this->post(to()->web->register->store(), [
            RegisterStoreRedirect::name => $guest->name,
            RegisterStoreRedirect::email => $guest->email,
            RegisterStoreRedirect::password => $guest->password,
            RegisterStoreRedirect::password_confirmation => $guest->password,
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
        $response->assertRedirectAs(RegisterStoreRedirect::redirect_as);
    }
}
