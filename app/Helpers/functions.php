<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('named_route')) {

    function named_route($route, $parameters = [], $absolute = true): string
    {
        if ($route instanceof \UnitEnum) {
            return route($route->name, $parameters, $absolute);
        }

        return route($route, $parameters, $absolute);
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
