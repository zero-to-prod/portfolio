<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Auth\Login;

class LoginRoutes
{

    /**
     * @see LoginIndexTest;
     * @see resources/views/login.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route_as(Routes::loginIndex, $parameters, $absolute);
    }

    /**
     * @see \App\Http\Controllers\Auth\Login;
     * @see LoginStoreTest;
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as(Routes::login, $parameters, $absolute);
    }
}
