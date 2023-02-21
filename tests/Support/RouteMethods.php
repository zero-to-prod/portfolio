<?php

namespace Tests\Support;

use Illuminate\Testing\TestResponse;
use UnitEnum;

trait RouteMethods
{
    protected function postRoute($route, array $data = [], array $headers = [], array $parameters = [], $absolute = true): TestResponse
    {
        if ($route instanceof UnitEnum) {
            return $this->post(route($route->name, $parameters, $absolute), $data, $headers);
        }

        return $this->post($route, $data, $headers);
    }
}
