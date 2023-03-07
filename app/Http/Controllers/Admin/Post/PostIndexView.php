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
        $published = Post::withoutGlobalScopes([Post::published])
            ->with([Post::views, Post::authors, Post::tags])
            ->whereNotNull(Post::published_at)
            ->orderByDesc(Post::published_at)
            ->limit(20)
            ->get();
        $unpublished = Post::withoutGlobalScopes([Post::published])
            ->with([Post::views, Post::authors, Post::tags])
            ->whereNull(Post::published_at)
            ->limit(20)
            ->get();

        return view_as(Views::admin_post_index, [self::posts => $unpublished->merge($published)]);
    }
}
