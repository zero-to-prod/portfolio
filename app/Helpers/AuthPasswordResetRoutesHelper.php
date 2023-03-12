<?php

namespace App\Helpers;

class AuthPasswordResetRoutesHelper
{

    public Routes $request = Routes::auth_passwordReset_request;
    public Routes $store = Routes::auth_passwordReset_store;
    public function store(): string
    {
        return route_as($this->store);
    }
    public function request(): string
    {
        return route_as('password.request');
    }
}
