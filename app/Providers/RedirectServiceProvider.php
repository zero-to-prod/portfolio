<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Redirect;

class RedirectServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->registerRouteAs();
        $this->registerToAs();
        $this->registerIntendedAs();
        $this->registerHome();
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

    /**
     * Registers additional route method on the Route Facade.
     *  - intendedAs(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum is used for the uri
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerIntendedAs(): void
    {
        Redirect::macro('intendedAs', function (mixed $default = '/', int $status = 302, array $headers = [], bool|null $secure = null) {
            if ($default instanceof \UnitEnum) {
                return Redirect::intended($default->value, $status, $headers, $secure);
            }
            return Redirect::intended($default, $status, $headers, $secure);
        });
    }

    protected function registerHome(): void
    {
        Redirect::macro('home', function (string|null $query_string = null) {
            return Redirect::intended(config('auth.home') . $query_string);
        });
    }
}
