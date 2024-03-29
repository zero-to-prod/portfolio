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
        $socialiteUser = Socialite::driver(Drivers::github->value)->user();

        $user = User::updateOrCreate([User::email => $socialiteUser->email], [
            User::github_id => $socialiteUser->id,
            User::name => $socialiteUser->name ?? $socialiteUser->nickname,
            User::email => $socialiteUser->email,
            User::email_verified_at => now(),
            User::github_token => $socialiteUser->token,
            User::github_refresh_token => $socialiteUser->refreshToken,
        ]);

        Auth::login($user, true);

        $uri = Session::get(SessionKeys::post->value);
        if ($uri !== null) {
            return redirect($uri);
        }

        return redirect(to()->welcome());
    }
}
