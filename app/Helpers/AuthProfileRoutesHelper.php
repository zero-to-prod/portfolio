<?php

namespace App\Helpers;

class AuthProfileRoutesHelper
{

    public Routes $destroy = Routes::auth_profile_destroy;

    public function destroy(): string
    {
        return route_as($this->destroy);
    }
}
