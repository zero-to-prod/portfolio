<?php

namespace App\Helpers\Routing;

class GuestRoutes
{

    public function __construct(public AdminLoginRoutes $admin_login = new AdminLoginRoutes)
    {
    }
}