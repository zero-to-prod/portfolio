<?php

namespace App\Helpers;

class GuestRoutes
{
    public function login(): string
    {
        return 'login';
    }

    public function loginStore(): string
    {
        return 'login/store';
    }
}