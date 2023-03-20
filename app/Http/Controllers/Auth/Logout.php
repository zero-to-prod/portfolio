<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Middlewares;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{

    /**
     * @see LogoutRedirectTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::guard(Middlewares::web->value)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
