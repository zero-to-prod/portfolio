<?php

namespace App\Helpers;

class ApiRoutes
{

    public Routes $subscribe = Routes::subscribe;

    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }
}
