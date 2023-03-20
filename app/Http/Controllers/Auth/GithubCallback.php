<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Drivers;
use App\Helpers\SessionKeys;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;
use Socialite;

class GithubCallback extends Controller
{

    public function __invoke(Request $request): RedirectResponse
    {
        $githubUser = Socialite::driver(Drivers::github->value)->user();

        $user = User::updateOrCreate([User::email => $githubUser->email], [
            User::name => $githubUser->name,
            User::email => $githubUser->email,
            User::email_verified_at => now(),
            User::github_token => $githubUser->token,
            User::github_refresh_token => $githubUser->refreshToken,
        ]);

        Auth::login($user, true);

        $uri = Session::get(SessionKeys::page->value);
        if ($uri !== null) {
            return redirect()->intended($uri);
        }

        return redirect()->intended(to()->web->welcome());
    }
}
