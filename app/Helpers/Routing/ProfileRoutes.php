<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;

class ProfileRoutes
{

    public Routes $destroy = Routes::auth_profile_destroy;
    public Routes $edit = Routes::auth_profile_edit;
    public Routes $update = Routes::auth_profile_update;

    public function update(): string
    {
        return route_as($this->update);
    }

    public function edit(): string
    {
        return route_as($this->edit);
    }

    public function destroy(): string
    {
        return route_as($this->destroy);
    }
}
