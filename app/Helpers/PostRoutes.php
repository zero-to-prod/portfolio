<?php

namespace App\Helpers;

use App\Models\Post;

class PostRoutes
{
    public Routes $index = Routes::admin_post_index;
    public Routes $create = Routes::admin_post_create;
    public Routes $store = Routes::admin_post_store;
    public Routes $edit = Routes::admin_post_edit;
    public Routes $publish = Routes::admin_post_publish;
    public Routes $unPublish = Routes::admin_post_unPublish;

    public function index(): string
    {
        return route_as($this->index);
    }
    public function store(): string
    {
        return route_as($this->store);
    }

    public function create(): string
    {
        return route_as($this->create);
    }
    public function edit(Post $post): string
    {
        return route_as($this->edit, $post);
    }

    public function publish(Post $post): string
    {
        return route_as($this->publish, $post);
    }

    public function unPublish(Post $post): string
    {
        return route_as($this->unPublish, $post);
    }
}
