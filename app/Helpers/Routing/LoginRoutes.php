<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class LoginRoutes
{
    public Routes $store = Routes::web_login_store;

    /**
     * @see LoginIndexTest;
     * @see resources/views/login.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route(Routes::login->name, $parameters, $absolute);
    }

    /**
     * @see LoginStoreRedirect;
     */
    public function store(): string
    {
        return route_as($this->store);
    }
}
