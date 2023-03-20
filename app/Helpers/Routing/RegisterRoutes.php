<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Register\VerificationNotice;
use App\Http\Controllers\Register\VerificationSend;

class RegisterRoutes
{

    public Routes $verification = Routes::register_verification;
    public Routes $notice = Routes::register_notice;
    public Routes $index = Routes::registerIndex;
    public Routes $store = Routes::register_store;

    /**
     * @see RegisterIndexTest;
     * @see resources/views/register.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route_as($this->index, $parameters, $absolute);
    }

    /**
     * @see Login;
     * @see LoginStoreTest;
     * @see routes/web.php
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as($this->store, $parameters, $absolute);
    }

    /**
     * @see RegisterNoticeViewTest;
     * @see routes/web.php
     */
    public function notice($parameters = [], $absolute = true): string
    {
        return route_as($this->notice, $parameters, $absolute);
    }

    /**
     * @see RegisterNoticeViewTest;
     * @see routes/web.php
     */
    public function verification($parameters = [], $absolute = true): string
    {
        return route_as($this->verification, $parameters, $absolute);
    }

    /**
     * @see VerificationNoticeTest
     * @see \App\Http\Controllers\Register\VerificationNotice
     * @see routes/web.php
     */
    public function verification_notice($parameters = [], $absolute = true): string
    {
        return route('verification.notice', $parameters, $absolute);
    }

    /**
     * @see VerificationSendTest
     * @see VerificationSend
     * @see routes/web.php
     */
    public function verification_send($parameters = [], $absolute = true): string
    {
        return route('verification.send', $parameters, $absolute);
    }
}
