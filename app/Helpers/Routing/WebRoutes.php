<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Models\File;
use App\Models\Post;

class WebRoutes
{
    public Routes $file = Routes::file;
    public Routes $read = Routes::read;


    public function __construct(
        public LoginRoutes    $login = new LoginRoutes,
        public RegisterRoutes $register = new RegisterRoutes,
    )
    {
    }



    public function read(Post $post): string
    {
        return route_as($this->read, $post);
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
