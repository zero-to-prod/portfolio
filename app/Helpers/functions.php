<?php

use App\Helpers\Environments;
use App\Helpers\RoutesHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

if (!function_exists('r')) {
    function r(): RoutesHelper
    {
        return new RoutesHelper;
    }
}

if (!function_exists('route_as')) {
    function route_as($route, mixed $parameters = [], $absolute = true): string
    {
        if ($route instanceof \UnitEnum) {
            return route($route->name, $parameters, $absolute);
        }

        return route($route, $parameters, $absolute);
    }
}

if (!function_exists('route_is')) {
    function route_is($route): bool
    {
        if ($route instanceof \UnitEnum) {
            return request()?->routeIs($route->name);
        }

        return route(...$route);
    }
}

if (!function_exists('route_contains')) {
    function route_contains(string $route): bool
    {
        return Str::contains(request()?->url(), $route, true);
    }
}

if (!function_exists('redirect_as')) {
    function redirect_as($to = null, $status = 302, $headers = [], $secure = null): Redirector|RedirectResponse|Application
    {
        if ($to instanceof \UnitEnum) {
            return redirect($to->value, $status, $headers, $secure);
        }

        return redirect($to->value, $status, $headers, $secure);
    }
}

if (!function_exists('view_as')) {
    function view_as($view = null, $data = [], $mergeData = []): \Illuminate\Contracts\View\View|Factory|Application
    {
        if ($view instanceof \UnitEnum) {
            return view($view->value, $data, $mergeData);
        }

        return view($view, $data, $mergeData);
    }
}

if (!function_exists('cached_view')) {
    function cached_view($view = null, $data = [], $mergeData = [], DateTimeInterface|DateInterval|int|null $ttl = null)
    {
        if (App::environment([Environments::local->value, Environments::testing->value])) {
            return view_as($view, $data, $mergeData);
        }

        if (Cache::hasView($view)) {
            return Cache::getView($view, $data);
        }

        $value = view_as($view, $data, $mergeData)->render();
        Cache::putView($view, $value, $ttl);

        return $value;
    }
}

if (!function_exists('route_name_is')) {
    function route_name_is($route): bool
    {
        if ($route instanceof \UnitEnum) {
            return Route::currentRouteName() === $route->name;
        }

        return Route::currentRouteName() === $route;
    }
}

if (!function_exists('route_name_isnt')) {
    function route_name_isnt($route): bool
    {
        return !route_name_is($route);
    }
}

if (!function_exists('route_is')) {
    function route_is($route): bool
    {
        if ($route instanceof \UnitEnum) {
            return Route::current()->uri === $route->value;
        }

        return Route::current()->uri === $route;
    }
}

if (!function_exists('route_isnt')) {
    function route_isnt($route): bool
    {
        return !route_is($route);
    }
}
