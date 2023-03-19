<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Views;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public const name = 'name';
    public const email = 'email';
    public const password = 'password';

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view_as(Views::auth_register);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            self::name => ['required', 'string', 'max:255'],
            self::email => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            self::password => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            self::name => $request->name,
            self::email => $request->email,
            self::password => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect()->intended(to()->web->register->notice());
    }
}
