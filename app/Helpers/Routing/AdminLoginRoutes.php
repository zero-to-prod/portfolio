<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class AdminLoginRoutes
{

    public Routes $index = Routes::admin_login_index;
    public Routes $store = Routes::admin_login_store;

    public function index(): string
    {
        return route_as($this->index);
    }

    public function store(): string
    {
        return route_as($this->store);
    }
}
