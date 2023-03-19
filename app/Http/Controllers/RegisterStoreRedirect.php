<?php

namespace App\Http\Controllers;

use App\Helpers\Routes;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use URL;

class RegisterStoreRedirect extends Controller
{

    public const name = 'name';
    public const email = 'email';
    public const password = 'password';
    public const password_confirmation = 'password_confirmation';
    public const redirect_as = Routes::register_notice;

    /**
     * @see RegisterStoreTest
     */
    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        $user = $request->createUser();

        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect(Url::temporarySignedRoute( self::redirect_as->name, self::expiration()));
    }
    public static function expiration(): Carbon
    {
        return now()->addMinutes(5);
    }
}
