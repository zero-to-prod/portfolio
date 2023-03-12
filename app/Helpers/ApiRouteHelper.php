<?php

namespace App\Helpers;

class ApiRouteHelper
{

    public Routes $subscribe = Routes::subscribe;

    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }
}
