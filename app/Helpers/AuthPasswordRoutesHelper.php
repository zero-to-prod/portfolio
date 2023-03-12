<?php

namespace App\Helpers;

class AuthPasswordRoutesHelper
{

    public Routes $store = Routes::auth_password_store;
    public Routes $confirm = Routes::auth_password_confirm;

    public function store(): string
    {
        return route_as($this->store);
    }

    public function confirm(): string
    {
        return route_as($this->confirm);
    }
}
