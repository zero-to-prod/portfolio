<?php

namespace App\Http\Controllers;

use App\Helpers\Routes;
use App\Helpers\SessionKeys;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Session;

class LoginStoreRedirect extends Controller
{
    public const redirect_as = Routes::welcome;

    /**
     * @throws ValidationException
     * @see LoginStoreTest
     */
    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $uri = Session::get(SessionKeys::page->value);
        if ($uri !== null) {
            return redirect()->intended($uri);
        }

        return redirect(route_as(self::redirect_as));
    }
}
