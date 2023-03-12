<?php

namespace App\Helpers;

class RoutesHelper
{

    public function __construct(
        public AdminRoutes      $admin = new AdminRoutes,
        public ApiRoutes        $api = new ApiRoutes,
        public AuthRoutesHelper $auth = new AuthRoutesHelper,
        public GuestRoutes      $guest = new GuestRoutes,
        public WebRoutes        $web = new WebRoutes,
    )
    {
    }
}