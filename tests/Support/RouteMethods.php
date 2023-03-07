<?php

namespace Tests\Support;

use Illuminate\Testing\TestResponse;

trait RouteMethods
{
    protected function postAs($route, array $data = [], array $headers = [], array $parameters = [], $absolute = true): TestResponse
    {
        if ($route instanceof \UnitEnum) {
            return $this->post(route_as($route, $parameters, $absolute), $data, $headers);
        }

        return $this->post($route, $data, $headers);
    }

    protected function getAs($uri, $parameters = [], array $headers = []): TestResponse
    {
        if ($uri instanceof \UnitEnum) {
            return $this->get(route_as($uri, $parameters, $headers));
        }

        return $this->get($uri, $headers);
    }
}
