<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class To
{
    public Routes $welcome = Routes::welcome;
    public Routes $search = Routes::search;

    public function __construct(
        public AdminRoutes $admin = new AdminRoutes,
        public ApiRoutes   $api = new ApiRoutes,
        public AuthRoutes  $auth = new AuthRoutes,
        public GuestRoutes $guest = new GuestRoutes,
        public WebRoutes   $web = new WebRoutes,
    )
    {
    }

    /**
     * @see WelcomeTest
     */
    public function welcome(): string
    {
        return route_as($this->welcome);
    }

    /**
     * @see SearchRedirectTest
     */
    public function search(): string
    {
        return route_as($this->search);
    }
}