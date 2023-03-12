<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ResultsView;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;

class WebRoutes
{
    public Routes $connect = Routes::connect;
    public Routes $connect_store = Routes::connect_store;
    public Routes $cv = Routes::cv;
    public Routes $file = Routes::file;
    public Routes $read = Routes::read;
    public Routes $search = Routes::search;
    public Routes $results = Routes::results;
    public Routes $welcome = Routes::welcome;

    public function welcome(): string
    {
        return route_as($this->welcome);
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

    public function connect(): string
    {
        return route_as($this->connect);
    }

    public function connectStore(): string
    {
        return route_as($this->connect_store);
    }
}
