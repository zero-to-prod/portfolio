<?php

namespace App\Http\Controllers\Register;

use App\Helpers\Routes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Store extends Controller
{

    public const name = 'name';
    public const email = 'email';
    public const password = 'password';
    public const password_confirmation = 'password_confirmation';
    public const redirect_as = Routes::register_verification;

    /**
     * @see RegisterStoreTest
     */
    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        $user = $request->createUser();

        event(new Registered($user));

        User::unguard();
        $user->update([User::email_verified_at => now()]);
        User::reguard();
        Auth::login($user);

        return redirect(self::redirectUrl());
    }

    public static function redirectUrl(): string
    {
        return temp_signed_route(self::redirect_as);
    }
}
