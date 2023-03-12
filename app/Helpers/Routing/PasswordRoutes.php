<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class PasswordRoutes
{

    public Routes $store = Routes::auth_password_store;
    public Routes $confirm = Routes::auth_password_confirm;
    public Routes $update = Routes::auth_password_update;

    public function update(): string
    {
        return route_as($this->update);
    }
    public function store(): string
    {
        return route_as($this->store);
    }

    public function confirm(): string
    {
        return route_as($this->confirm);
    }
}
