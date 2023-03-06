<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Support\Collection;

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