<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ResultsView;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;

class R
{

    public static function file(File $file, ?int $width = null, ?int $height = null): string
    {
        return route_as(Routes::file, [
            FileServeResponse::file => $file->name,
            FileServeResponse::width => $width,
            FileServeResponse::height => $height,
        ]);
    }
    public static function admin_tag_create(): string
    {
        return route_as(Routes::admin_tag_create);
    }
    public static function admin_tag_store(): string
    {
        return route_as(Routes::admin_tag_store);
    }

    public static function admin_post_create(): string
    {
        return route_as(Routes::admin_post_create);
    }

    public static function admin_post_store(): string
    {
        return route_as(Routes::admin_post_store);
    }

    public static function admin_post_publish(Post $post): string
    {
        return route_as(Routes::admin_post_publish, $post);
    }

    public static function admin_post_edit(Post $post): string
    {
        return route_as(Routes::admin_post_edit, $post);
    }

    public static function admin_tag_edit(Tag $tag): string
    {
        return route_as(Routes::admin_tag_edit, $tag);
    }

    public static function email_verificationNotification(): string
    {
        return route_as(Routes::email_verificationNotification);
    }

    public static function profile_update(): string
    {
        return route_as(Routes::profile_update);
    }

    public static function results_tag(Tag $tag): string
    {
        return route_as(Routes::results, [ResultsView::tag => $tag->slug]);
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

    public static function results(Tag $tag): string
    {
        return route_as(Routes::results, [ResultsView::tag => $tag->slug]);
    }

    public static function connect_store(): string
    {
        return route_as(Routes::connect_store);
    }
}