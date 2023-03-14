<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class ApiRoutes
{

    public Routes $subscribe = Routes::api_v1_subscribe;
    public Routes $thanks = Routes::api_v1_thanks;

    public function thanks(): string
    {
        return route_as($this->thanks);
    }
    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }
}
