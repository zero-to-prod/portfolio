<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
class AdminRouteHelper
{

    public Routes $dashboard = Routes::dashboard;

    public function __construct(
        public AuthorRoutes $author = new AuthorRoutes,
        public PostRoutes   $post = new PostRoutes,
        public TagRoutes    $tag = new TagRoutes,
    )
    {
    }

    public function dashboard(): string
    {
        return route_as($this->dashboard);
    }
}
