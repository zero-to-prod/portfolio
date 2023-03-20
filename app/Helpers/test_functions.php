<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\AuthorFactory;
use Database\Factories\FileFactory;
use Database\Factories\PostFactory;
use Database\Factories\TagFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Collection;

if (!function_exists('author')) {
    function author(array $attributes = [], $count = null, array $state = []): Author|Collection
    {
        return author_f($count, $state)->create($attributes);
    }
}
if (!function_exists('author_f')) {
    function author_f($attributes = null, array $state = []): AuthorFactory
    {
        return Author::factory($attributes, $state);
    }
}
if (!function_exists('file')) {
    function file(array $attributes = [], $count = null, array $state = []): File|Collection
    {
        return file_f($count, $state)->create($attributes);
    }
}
if (!function_exists('file_f')) {
    function file_f($attributes = null, array $state = []): FileFactory
    {
        return File::factory($attributes, $state);
    }
}
if (!function_exists('post')) {
    function post(array $attributes = [], $count = null, array $state = []): Post|Collection
    {
        return post_f($count, $state)->create($attributes);
    }
}
if (!function_exists('post_f')) {
    function post_f($attributes = null, array $state = []): PostFactory
    {
        return Post::factory($attributes, $state);
    }
}
if (!function_exists('tag')) {
    function tag(array $attributes = [], $count = null, array $state = []): Tag|Collection
    {
        return tag_f($count, $state)->create($attributes);
    }
}
if (!function_exists('tag_f')) {
    function tag_f($attributes = null, array $state = []): TagFactory
    {
        return Tag::factory($attributes, $state);
    }
}
if (!function_exists('user')) {
    function user(array $attributes = [], $count = null, array $state = []): User|Collection
    {
        return user_f($count, $state)->create($attributes);
    }
}
if (!function_exists('user_f')) {
    function user_f($attributes = null, array $state = []): UserFactory
    {
        return User::factory($attributes, $state);
    }
}