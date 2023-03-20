<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Login\StoreRedirect;

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
     * @see StoreRedirect;
     * @see LoginStoreTest;
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as(Routes::login_store, $parameters, $absolute);
    }
}
