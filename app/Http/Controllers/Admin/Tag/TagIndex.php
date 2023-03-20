<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Helpers\TagTypes;
use App\Helpers\Views;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagIndex extends Controller
{
    public const tags = 'tags';
    public const views = 'views';

    public function __invoke(Request $request): View|Factory|Application
    {
        return view_as(Views::admin_tag_index, [
            self::tags => Tag::withType(TagTypes::post->value)
                ->with( Tag::file)
                ->withCount(Tag::posts)
                ->withSum(Tag::posts . ' as ' . self::views, Post::views)
                ->orderByDesc(self::views)
                ->get()
        ]);
    }
}
