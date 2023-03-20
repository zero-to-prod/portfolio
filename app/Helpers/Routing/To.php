<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ResultsView;
use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;

class To
{
    public Routes $welcome = Routes::welcome;
    public Routes $read = Routes::read;
    public Routes $search = Routes::search;
    public Routes $results = Routes::results;
    public Routes $file = Routes::file;
    public Routes $tos = Routes::tos;
    public Routes $privacy = Routes::privacy;
    public Routes $newsletter = Routes::newsletter;
    public Routes $subscribe = Routes::subscribe;
    public Routes $contact = Routes::contact;
    public Routes $contact_store = Routes::contact_store;

    public function __construct(
        public LoginRoutes    $login = new LoginRoutes,
        public RegisterRoutes $register = new RegisterRoutes,
        public AdminRoutes $admin = new AdminRoutes,
        public ApiRoutes   $api = new ApiRoutes,
        public AuthRoutes  $auth = new AuthRoutes,
        public GuestRoutes $guest = new GuestRoutes,
    )
    {
    }

    /**
     * @see WelcomeTest
     */
    public function welcome(): string
    {
        return route_as($this->welcome);
    }

    public function read(Post $post): string
    {
        return route_as($this->read, $post);
    }

    /**
     * @see SearchRedirectTest
     */
    public function search(): string
    {
        return route_as($this->search);
    }

    public function results(?Tag $tag = null): string
    {
        if (is_null($tag)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::topic => $tag]);
    }

    public function resultsTopics(): string
    {
        return route_as($this->results, [ResultsView::topics => true]);
    }

    public function resultsPopular(): string
    {
        return route_as($this->results, [ResultsView::popular => true]);
    }

    public function resultsAuthor(?Author $author): string
    {
        if (is_null($author)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::author => $author]);
    }

    public function file(File $file, ?int $width = null, ?int $height = null): string
    {
        return route_as($this->file, [
            FileServeResponse::file => $file->name,
            FileServeResponse::width => $width,
            FileServeResponse::height => $height,
        ]);
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

    public function contact(): string
    {
        return route_as($this->contact);
    }

    public function contact_store(): string
    {
        return route_as($this->contact_store);
    }
}