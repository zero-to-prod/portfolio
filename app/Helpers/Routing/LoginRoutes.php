<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Auth\Login;

class LoginRoutes
{

    public Routes $index = Routes::loginIndex;
    public Routes $store = Routes::login_store;

    /**
     * @see LoginIndexTest;
     * @see resources/views/login.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route_as($this->index, $parameters, $absolute);
    }

    /**
     * @see \App\Http\Controllers\Auth\Login;
     * @see LoginStoreTest;
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as($this->store, $parameters, $absolute);
    }
}
