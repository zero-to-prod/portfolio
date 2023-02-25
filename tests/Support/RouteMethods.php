<?php

namespace Tests\Support;

use Illuminate\Testing\TestResponse;

trait RouteMethods
{
    protected function postRoute($route, array $data = [], array $headers = [], array $parameters = [], $absolute = true): TestResponse
    {
        if ($route instanceof \UnitEnum) {
            return $this->post(named_route($route, $parameters, $absolute), $data, $headers);
        }

        return $this->post($route, $data, $headers);
    }

    protected function getRoute($uri, array $headers = []): TestResponse
    {
        if ($uri instanceof \UnitEnum) {
            return $this->get(named_route($uri, $headers));
        }

        return $this->get($uri, $headers);
    }
}
