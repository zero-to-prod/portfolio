<?php

namespace App\Http\Controllers;

use App\Helpers\Drivers;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Socialite;

class GithubCallback extends Controller
{

    public function __invoke(Request $request): Redirector|RedirectResponse|Application
    {
        $githubUser = Socialite::driver(Drivers::github->value)->user();

        $user = User::updateOrCreate([User::github_id => $githubUser->id], [
            User::name => $githubUser->name,
            User::email => $githubUser->email,
            User::github_token => $githubUser->token,
            User::github_refresh_token => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect()->intended(to()->web->welcome());
    }
}
