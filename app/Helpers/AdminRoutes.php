<?php

namespace App\Helpers;

class AdminRoutes
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
