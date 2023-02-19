<?php


use App\Http\Routes;
use Illuminate\Support\Facades\Route;

if (!function_exists('route_name_is')) {

    function route_name_is($route): bool
    {
        if ($route instanceof \UnitEnum) {
            return Route::currentRouteName() === $route->name;
        }

        return Route::currentRouteName() === $route;
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
