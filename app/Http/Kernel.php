<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        Middleware::web->value => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\PostViewCounter::class,
        ],

        Middleware::api->value => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        Middleware::web_group->value => [],
        Middleware::auth_group->value => [],
        Middleware::guest_group->value => [],
        Middleware::register_group->value => [],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        Middleware::auth->value => \App\Http\Middleware\Authenticate::class,
        Middleware::auth_basic->value => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        Middleware::auth_session->value => \Illuminate\Session\Middleware\AuthenticateSession::class,
        Middleware::cache_headers->value => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        Middleware::can->value => \Illuminate\Auth\Middleware\Authorize::class,
        Middleware::guest->value => \App\Http\Middleware\RedirectIfAuthenticated::class,
        Middleware::password_confirm->value => \Illuminate\Auth\Middleware\RequirePassword::class,
        Middleware::signed->value => \App\Http\Middleware\ValidateSignature::class,
        Middleware::throttle->value => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        Middleware::verified->value => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
