<?php

namespace App\Helpers\Routing;

class To
{

    public function __construct(
        public AdminRoutes $admin = new AdminRoutes,
        public ApiRoutes   $api = new ApiRoutes,
        public AuthRoutes  $auth = new AuthRoutes,
        public GuestRoutes $guest = new GuestRoutes,
        public WebRoutes   $web = new WebRoutes,
    )
    {
    }
}