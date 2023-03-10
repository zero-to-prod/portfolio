<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class PasswordNewRoutes
{

    public Routes $create = Routes::auth_passwordNew_create;
    public Routes $store = Routes::auth_passwordNew_store;
    public function store(): string
    {
        return route_as('password.store');
    }
    public function create(?string $token): string
    {
        return route_as($this->create, ['token' => $token]);
    }
}
