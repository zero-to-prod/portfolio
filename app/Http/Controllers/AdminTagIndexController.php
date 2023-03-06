<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminTagIndexController extends Controller
{
    public const tags = 'tags';
    public const views = 'views';

    public function __invoke(Request $request): View|Factory|Application
    {
        return view_as(Views::admin_tag_index, [
            self::tags => Tag::withCount(Tag::posts)
                ->withSum(Tag::posts . ' as ' . self::views, Post::views)
                ->orderByDesc(self::views)
                ->get()
        ]);
    }
}
