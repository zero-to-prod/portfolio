<?php

namespace App\Http\Controllers\Admin\Post;

use App\Helpers\Views;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostIndexView extends Controller
{
    public const posts = 'posts';

    public function __invoke(Request $request): View|Factory|Application
    {
        $all_posts = Post::withoutGlobalScopes([Post::published])
            ->with([Post::views, Post::authors, Post::tags])
            ->orderByDesc(Post::published_at)
            ->get();
        $published = $all_posts->whereNotNull(Post::published_at);
        $unpublished = $all_posts->whereNull(Post::published_at);

        return view_as(Views::admin_post_index, [self::posts => $unpublished->merge($published)]);
    }
}
