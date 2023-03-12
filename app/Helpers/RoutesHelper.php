<?php

namespace App\Helpers;

class RoutesHelper
{

    public function __construct(
        public AdminRouteHelper $admin = new AdminRouteHelper,
        public ApiRoutes        $api = new ApiRoutes,
        public GuestRoutes      $guest = new GuestRoutes,
        public WebRoutes        $web = new WebRoutes,
    )
    {
    }
}