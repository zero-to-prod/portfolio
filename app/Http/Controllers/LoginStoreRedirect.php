<?php

namespace App\Http\Controllers;

use App\Helpers\SessionKeys;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Session;

class LoginStoreRedirect extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $uri = Session::get(SessionKeys::page->value);
        if ($uri !== null) {
            return redirect()->intended($uri);
        }

        return redirect()->intended(to()->web->welcome());
    }
}
