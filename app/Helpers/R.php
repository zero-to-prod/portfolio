<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ResultsView;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;

class R
{

    public static function upload(): string
    {
        return route_as(AuthRoutes::upload);
    }

    public static function file(File $file, ?int $width = null, ?int $height = null): string
    {
        return route_as(Routes::file, [
            FileServeResponse::file => $file->name,
            FileServeResponse::width => $width,
            FileServeResponse::height => $height,
        ]);
    }

    public static function email_verificationNotification(): string
    {
        return route_as(AuthRoutes::email_verificationNotification);
    }

    public static function profile_update(): string
    {
        return route_as(AuthRoutes::profile_update);
    }

    public static function results_popular(): string
    {
        return route_as(Routes::results, [ResultsView::popular => true]);
    }

    public static function results_topics(): string
    {
        return route_as(Routes::results, [ResultsView::topics => true]);
    }

    public static function welcome(): string
    {
        return route_as(Routes::welcome);
    }

    public static function read(Post $post): string
    {
        return route_as(Routes::read, $post);
    }

    public static function results(?Tag $tag = null): string
    {
        if (is_null($tag)) {
            return route_as(Routes::results);
        }

        return route_as(Routes::results, [ResultsView::tag => $tag->slug]);
    }

    public static function connect_store(): string
    {
        return route_as(Routes::connect_store);
    }

    public static function connect(): string
    {
        return route_as(Routes::connect);
    }

    public static function search(): string
    {
        return route_as(Routes::search);
    }
}