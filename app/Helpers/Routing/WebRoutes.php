<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Models\File;
use App\Models\Post;

class WebRoutes
{
    public Routes $connect_store = Routes::contact_store;
    public Routes $contact = Routes::contact;
    public Routes $file = Routes::file;
    public Routes $privacy = Routes::privacy;
    public Routes $read = Routes::read;
    public Routes $results = Routes::results;
    public Routes $search = Routes::search;
    public Routes $newsletter = Routes::newsletter;
    public Routes $subscribe = Routes::subscribe;
    public Routes $tos = Routes::tos;

    public function __construct(
        public LoginRoutes    $login = new LoginRoutes,
        public RegisterRoutes $register = new RegisterRoutes,
    )
    {
    }

    public function tos(): string
    {
        return route_as($this->tos);
    }

    public function privacy(): string
    {
        return route_as($this->privacy);
    }

    public function newsletter(): string
    {
        return route_as($this->newsletter);
    }

    public function subscribe(): string
    {
        return route_as($this->subscribe);
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

    public function contact(): string
    {
        return route_as($this->contact);
    }

    public function connectStore(): string
    {
        return route_as($this->connect_store);
    }
}
