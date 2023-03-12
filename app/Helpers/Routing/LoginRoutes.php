<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class LoginRoutes
{

    public Routes $index = Routes::guest_login_index;
    public Routes $store = Routes::guest_login_store;

    public function index(): string
    {
        return route_as($this->index);
    }

    public function store(): string
    {
        return route_as($this->store);
    }
}
