<?php

namespace App\Http\Middleware;

use App\Helpers\AuthRoutes;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tests\Feature\Middleware\AuthenticateTest;

class Authenticate extends Middleware
{
    /**
     * @see AuthenticateTest
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route_as(AuthRoutes::login);
    }
}
