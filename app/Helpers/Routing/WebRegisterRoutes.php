<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class WebRegisterRoutes
{

    /**
     * @see RegisterIndexTest;
     * @see resources/views/register.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route_as(Routes::registerIndex, $parameters, $absolute);
    }

    /**
     * @see LoginStoreRedirect;
     * @see LoginStoreTest;
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as(Routes::register_store, $parameters, $absolute);
    }
}
