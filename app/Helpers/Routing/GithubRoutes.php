<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class GithubRoutes
{

    public Routes $index = Routes::auth_github_index;
    public Routes $callback = Routes::auth_github_callback;

    public function index(): string
    {
        return route_as($this->index);
    }

    public function callback(): string
    {
        return route_as($this->callback);
    }
}
