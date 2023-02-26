<?php

namespace Tests\Support;

use Route;

trait GetRouteList
{
    protected function getRouteList($middleware): array
    {
        if ($middleware instanceof \UnitEnum) {
            $middleware = $middleware->value;
        }

        $this->setUp();
        $routes = [];
        foreach (Route::getRoutes() as $route) {
            $has_GET_method = in_array('GET', $route->methods, true);
            $has_middleware = in_array($middleware, $route->middleware(), true);

            if ($has_GET_method && $has_middleware) {
                $name = $route->getName();
                $routes['Route: ' . $name] = [$name];
            }
        }

        return $routes;
    }
}
