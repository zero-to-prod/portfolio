<?php

namespace App\Helpers\Routing;

class GuestRoutes
{

    public function __construct(public LoginRoutes $login = new LoginRoutes)
    {
    }
}