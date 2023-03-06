<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public const query = 'query';
    public const tag = 'tag';
    public const topics = 'topics';
    public const popular = 'popular';
    public const posts = 'posts';
    public const limit = 20;

    public function __invoke(Request $request): View|Factory|Application
    {
        $posts = null;
        $search = $request->query(self::query);
        $tag = $request->query(self::tag);
        $popular = $request->query(self::popular);

        if ($search !== null) {
            $posts = Post::where(static function (Builder $query) use ($search) {
                $query->where(Post::title, 'LIKE', "%{$search}%")
                    ->orWhere(Post::body, 'LIKE', "%{$search}%");
            })
                ->with([Post::tags, Post::authors])
                ->orderByDesc(Post::views)
                ->get();

            $related = Post::related($posts->pluck(Post::tags)->flatten(), $posts->pluck(Post::id)->toArray());
            $posts = $posts->merge($related);
        }

        if ($tag !== null) {
            $posts = Post::related($tag, limit: self::limit);
        }

        if ($popular !== null) {
            $posts = Post::with([Post::tags, Post::authors])
                ->orderByDesc(Post::views)
                ->limit(self::limit)
                ->get();
        }

        return view_as(Views::results, [self::posts => $posts]);
    }
}
