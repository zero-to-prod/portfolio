<?php

namespace App\Http;

use App\Helpers\Middlewares;
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
        Middlewares::web->value => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\DenyUnpublishedPosts::class,
            \App\Http\Middleware\PostViewCounter::class,
        ],

        Middlewares::api->value => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        Middlewares::web_group->value => [],
        Middlewares::auth_group->value => [],
        Middlewares::guest_group->value => [],
        Middlewares::register_group->value => [],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        Middlewares::auth->value => \App\Http\Middleware\Authenticate::class,
        Middlewares::auth_basic->value => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        Middlewares::auth_session->value => \Illuminate\Session\Middleware\AuthenticateSession::class,
        Middlewares::cache_headers->value => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        Middlewares::can->value => \Illuminate\Auth\Middleware\Authorize::class,
        Middlewares::guest->value => \App\Http\Middleware\RedirectIfAuthenticated::class,
        Middlewares::password_confirm->value => \Illuminate\Auth\Middleware\RequirePassword::class,
        Middlewares::signed->value => \App\Http\Middleware\ValidateSignature::class,
        Middlewares::throttle->value => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        Middlewares::verified->value => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
