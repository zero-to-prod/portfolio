<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class GoogleRoutes
{

    public Routes $index = Routes::auth_google_index;
    public Routes $callback = Routes::auth_google_callback;

    public function index(): string
    {
        return route_as($this->index);
    }

    public function callback(): string
    {
        return route_as($this->callback);
    }
}
