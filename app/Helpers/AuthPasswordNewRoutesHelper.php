<?php

namespace App\Helpers;

class AuthPasswordNewRoutesHelper
{

    public Routes $create = Routes::auth_passwordNew_create;

    public function create(?string $token): string
    {
        return route_as($this->create, ['token' => $token]);
    }
}
