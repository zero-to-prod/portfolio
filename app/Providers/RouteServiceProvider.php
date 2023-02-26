<?php

namespace App\Providers;

use App;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'web_group'])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth', 'auth_group'])
                ->group(base_path('routes/auth.php'));

            Route::middleware(['web', 'guest_group'])
                ->group(base_path('routes/guest.php'));

            if (App::environment('testing')) {
                Route::middleware(['web', 'guest'])
                    ->group(base_path('routes/register.php'));
            }

        });

        $this->registerAsMethods();
        $this->registerRouteAs();
        $this->registerToAs();
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Registers additional route methods on the Route Facade.
     *  - Route::getAs(...$args),
     *  - Route::postAs(...$args),
     *  - .etc
     *
     * These methods can be useful when you want to:
     *  - use an Enum to define your routes
     *  - name the routes based on the Enum name
     *
     * If an Enum is passed for the first argument:
     *  - the Enum is used for the uri
     *  - the Enum name is used for the route name
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerAsMethods(): void
    {
        foreach (['get', 'post', 'put', 'patch', 'delete', 'options', 'any'] as $method) {
            Route::macro($method . 'As', function ($uri, array|string|callable|null|\UnitEnum $action = null, $cached = false) use ($method) {
                if (!$uri instanceof \UnitEnum) {
                    return Route::$method($uri, $action);
                }

                if (!$action instanceof \UnitEnum) {
                    return Route::$method($uri->value, $action)->name($uri->name);
                }

                if ($cached) {
                    return Route::$method($uri->value, fn() => cached_view($action))->name($uri->name);
                }

                return Route::$method($uri->value, fn() => view_as($action))->name($uri->name);
            });
        }
    }

    /**
     * Registers additional route method on the Route Facade.
     *  - routeAs(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum is used for the uri
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerRouteAs(): void
    {
        Redirect::macro('routeAs', function ($route, $parameters = [], $status = 302, $headers = []) {
            if ($route instanceof \UnitEnum) {
                return Redirect::route($route->name, $parameters, $status, $headers);
            }

            return Redirect::route($route, $parameters, $status, $headers);
        });
    }

    /**
     * Registers additional route method on the Route Facade.
     *  - toRoute(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum is used for the uri
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerToAs(): void
    {
        Redirect::macro('toAs', function ($path, $status = 302, $headers = [], $secure = null) {
            return Redirect::to(route_as($path), $status, $headers, $secure);
        });
    }
}
