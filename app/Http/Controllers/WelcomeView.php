<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WelcomeView extends Controller
{

    public const tags = 'tags';

    public function __invoke(): View|Factory|Application
    {
        $tags = Tag::mostViewed()->with([
            Tag::posts => static fn($query) => $query->orderByDesc(Post::views)->with([Post::authors, Post::file]),
        ])->get();

        return view('welcome', [self::tags => $tags]);
    }
}
