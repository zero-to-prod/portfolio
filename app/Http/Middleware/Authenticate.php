<?php

namespace App\Http\Middleware;

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
        return $request->expectsJson() ? null : to()->login->index();
    }
}
