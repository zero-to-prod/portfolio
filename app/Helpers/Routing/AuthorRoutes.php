<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Models\Author;

class AuthorRoutes
{
    public Routes $index = Routes::admin_author_index;
    public Routes $create = Routes::admin_author_create;
    public Routes $store = Routes::admin_author_store;
    public Routes $edit = Routes::admin_author_edit;

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

    public function edit(Author $author): string
    {
        return route_as($this->edit, $author);
    }
}
