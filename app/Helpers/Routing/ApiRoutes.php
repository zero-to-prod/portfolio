<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class ApiRoutes
{

    public Routes $subscribe = Routes::subscribe;

    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }
}
