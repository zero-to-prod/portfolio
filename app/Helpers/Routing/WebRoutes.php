<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Models\File;

class WebRoutes
{
    public Routes $file = Routes::file;

    public function __construct(
        public LoginRoutes    $login = new LoginRoutes,
        public RegisterRoutes $register = new RegisterRoutes,
    )
    {
    }

    public function file(File $file, ?int $width = null, ?int $height = null): string
    {
        return route_as($this->file, [
            FileServeResponse::file => $file->name,
            FileServeResponse::width => $width,
            FileServeResponse::height => $height,
        ]);
    }
}
