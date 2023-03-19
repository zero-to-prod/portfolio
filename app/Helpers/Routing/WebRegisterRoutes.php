<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class WebRegisterRoutes
{

    public Routes $verification = Routes::register_verification;

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
     * @see routes/web.php
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as(Routes::register_store, $parameters, $absolute);
    }

    /**
     * @see RegisterNoticeViewTest;
     * @see routes/web.php
     */
    public function notice($parameters = [], $absolute = true): string
    {
        return route_as(Routes::register_notice, $parameters, $absolute);
    }

    /**
     * @see RegisterNoticeViewTest;
     * @see routes/web.php
     */
    public function verification($parameters = [], $absolute = true): string
    {
        return route_as($this->verification, $parameters, $absolute);
    }
}
