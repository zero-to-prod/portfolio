<?php

namespace App\Helpers;

use App\Models\Tag;

class TagRoutes
{
    public Routes $index = Routes::admin_tag_index;
    public Routes $create = Routes::admin_tag_create;
    public Routes $store = Routes::admin_tag_store;
    public Routes $edit = Routes::admin_tag_edit;

    public function index(): string
    {
        return route_as($this->index);
    }

    public function create(): string
    {
        return route_as($this->create);
    }

    public function store(): string
    {
        return route_as($this->store);
    }

    public function edit(Tag $tag): string
    {
        return route_as($this->edit, $tag);
    }
}
