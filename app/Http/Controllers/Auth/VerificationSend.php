<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Register\VerificationSendTest;

class VerificationSend extends Controller
{

    /**
     * @see VerificationSendTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect(self::redirectUrl());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public static function redirectUrl(): string
    {
        return to()->web->welcome();
    }
}
