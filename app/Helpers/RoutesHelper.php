<?php

namespace App\Helpers;

class RoutesHelper
{

    public function __construct(
        public GuestRoutes $guest = new GuestRoutes
    )
    {

    }
}