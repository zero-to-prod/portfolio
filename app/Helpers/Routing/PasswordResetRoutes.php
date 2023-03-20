<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class PasswordResetRoutes
{

    public Routes $request = Routes::passwordReset_request;
    public Routes $store = Routes::passwordReset_store;
    public function store(): string
    {
        return route_as($this->store);
    }
    public function request(): string
    {
        return route_as('password.request');
    }
}
