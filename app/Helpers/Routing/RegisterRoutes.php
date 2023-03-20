<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Register\VerificationNotice;
use App\Http\Controllers\Register\VerificationSend;
use Register\NoticeTest;
use Tests\Feature\Register\IndexTest;

class RegisterRoutes
{

    public Routes $verification = Routes::register_verification;
    public Routes $notice = Routes::register_notice;
    public Routes $index = Routes::registerIndex;
    public Routes $store = Routes::register_store;

    /**
     * @see IndexTest;
     * @see resources/views/register/index.blade.php;
     * @see routes/web.php
     */
    public function index($parameters = [], $absolute = true): string
    {
        return route_as($this->index, $parameters, $absolute);
    }

    /**
     * @see Login;
     * @see LoginTest;
     * @see routes/web.php
     */
    public function store($parameters = [], $absolute = true): string
    {
        return route_as($this->store, $parameters, $absolute);
    }

    /**
     * @see NoticeTest;
     * @see resources/views/register/notice.blade.php;
     * @see routes/web.php
     */
    public function notice($parameters = [], $absolute = true): string
    {
        return route_as($this->notice, $parameters, $absolute);
    }

    /**
     * @see VerificationTest;
     * @see resources/views/register/verification.blade.php;
     * @see routes/web.php
     */
    public function verification($parameters = [], $absolute = true): string
    {
        return route_as($this->verification, $parameters, $absolute);
    }

    /**
     * @see VerificationNoticeTest
     * @see VerificationNotice
     * @see resources/views/register/verification_notice.blade.php;
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
