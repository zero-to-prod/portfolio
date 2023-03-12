<?php

namespace App\Helpers;

class R
{

    public static function profile_update(): string
    {
        return route_as(AuthRoutes::profile_update);
    }
}