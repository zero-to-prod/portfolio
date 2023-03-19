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
        return route_as(Routes::login, $parameters, $absolute);
    }

    /**
     * @see LoginStoreRedirect;
     * @see LoginStoreTest;
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as(Routes::web_login_store, $parameters, $absolute);
    }
}
