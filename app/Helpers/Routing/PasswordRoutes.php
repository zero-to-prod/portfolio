<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class PasswordRoutes
{

    public Routes $store = Routes::password_store;
    public Routes $confirm = Routes::password_confirm;
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
