<?php

namespace App\Helpers;

class AuthRoutesHelper
{

    public Routes $upload = Routes::auth_upload;

    public function upload(): string
    {
        return route_as($this->upload);
    }
}
