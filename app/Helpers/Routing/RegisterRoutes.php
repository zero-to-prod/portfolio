<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class RegisterRoutes
{

    public Routes $index = Routes::auth_register_index;
    public Routes $store = Routes::auth_register_store;

    public function store(): string
    {
        return route_as($this->store);
    }

    public function index(): string
    {
        return route_as($this->index);
    }
}
