<?php

namespace App\Http\Controllers;

use App\Http\Views;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public const query = 'query';
    public const posts = 'posts';

    public function __invoke(Request $request): View|Factory|Application
    {
        $search = $request->query(self::query);

        $posts = Post::where(static function ($query) use ($search) {
            $query->where(Post::title, 'LIKE', "%{$search}%")
                ->orWhere(Post::body, 'LIKE', "%{$search}%");
        })
            ->with([Post::tags, Post::authors])
            ->orderByDesc(Post::views)
            ->get();

        $recommended = Post::recommended($posts->pluck(Post::tags)->flatten(), $posts->pluck(Post::id)->toArray());

        return view_as(Views::results, [self::posts => $posts->merge($recommended)]);
    }
}
