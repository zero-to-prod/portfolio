<?php

namespace App\Http\Controllers;

use App\Helpers\Drivers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Socialite;

class GithubRedirect extends Controller
{

    public function __invoke(Request $request): Redirector|RedirectResponse|Application
    {
        return Socialite::driver(Drivers::github->value)->redirect();
    }
}
