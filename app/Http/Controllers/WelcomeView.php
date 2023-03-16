<?php

namespace App\Http\Controllers;

use App\Helpers\CacheKeys;
use App\Helpers\Views;
use App\Models\Post;
use App\Models\Tag;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WelcomeView extends Controller
{

    public const tags = 'tags';

    public function __invoke(): View|Factory|Application
    {
        $tags = Cache::rememberAs(CacheKeys::welcome, 60 * 60, static function () {
            return Tag::mostViewed()->with([
                Tag::posts => static fn($query) => $query->orderByDesc(Post::views)->with([Post::authors, Post::file]),
            ])->get();
        });

        return view_as(Views::welcome, [self::tags => $tags]);
    }
}
