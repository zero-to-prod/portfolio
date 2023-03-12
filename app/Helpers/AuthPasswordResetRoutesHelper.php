<?php

namespace App\Helpers;

class AuthPasswordResetRoutesHelper
{

    public Routes $request = Routes::auth_passwordReset_request;

    public function request(): string
    {
        return route_as('password.request');
    }
}
