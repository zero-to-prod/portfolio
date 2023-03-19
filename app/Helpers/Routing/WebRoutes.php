<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ResultsView;
use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;

class WebRoutes
{
    public Routes $connect_store = Routes::connect_store;
    public Routes $contact = Routes::contact;
    public Routes $cv = Routes::cv;
    public Routes $file = Routes::file;
    public Routes $privacy = Routes::privacy;
    public Routes $read = Routes::read;
    public Routes $results = Routes::results;
    public Routes $register_store = Routes::register_store;
    public Routes $register_notice = Routes::register_notice;
    public Routes $register_success = Routes::register_success;
    public Routes $search = Routes::search;
    public Routes $newsletter = Routes::newsletter;
    public Routes $subscribe = Routes::subscribe;
    public Routes $tos = Routes::tos;
    public Routes $welcome = Routes::welcome;

    public function __construct(
        public LoginRoutes       $login = new LoginRoutes,
        public WebRegisterRoutes $register = new WebRegisterRoutes,
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

    public function registerStore(): string
    {
        return route_as($this->register_store);
    }

    public function registerSuccess(): string
    {
        return route_as($this->register_success);
    }

    public function registerNotice(): string
    {
        return route_as($this->register_notice);
    }

    public function welcome(): string
    {
        return route_as($this->welcome);
    }

    public function newsletter(): string
    {
        return route_as($this->newsletter);
    }

    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }

    public function resultsTopics(): string
    {
        return route_as($this->results, [ResultsView::topics => true]);
    }

    public function resultsPopular(): string
    {
        return route_as($this->results, [ResultsView::popular => true]);
    }

    public function results(?Tag $tag = null): string
    {
        if (is_null($tag)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::tag => $tag->slug]);
    }

    public function resultsAuthor(?Author $author = null): string
    {
        if (is_null($author)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::author => $author->slug]);
    }

    public function search(): string
    {
        return route_as($this->search);
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

    public function cv(): string
    {
        return route_as($this->cv);
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
