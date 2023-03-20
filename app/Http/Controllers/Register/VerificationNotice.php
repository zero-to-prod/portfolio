<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationNotice extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect(self::redirectUrl())
                    : view('register.verification_notice');
    }

    public static function redirectUrl(): string
    {
        return to()->web->welcome();
    }
}
