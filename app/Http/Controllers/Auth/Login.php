<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Routes;
use App\Helpers\SessionKeys;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Session;

class Login extends Controller
{

    /**
     * @throws ValidationException
     * @see LoginTest
     */
    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $uri = Session::get(SessionKeys::page->value);
        if ($uri !== null) {
            return redirect()->intended($uri);
        }

        return redirect_as(self::redirectUrl());
    }

    public static function redirectUrl(): Routes
    {
        return to()->welcome;
    }
}
