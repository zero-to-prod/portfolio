<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostForm extends Controller
{
    public const post_model = 'post_model';
    public const post = 'post';
    public const author_model = 'author_model';

    public function __invoke(Request $request): View|Factory|Application
    {
        $post = $request->{self::post};
        $post_model = null;
        $author_model = null;
        if ($post !== null) {
            $post_model = Post::withoutGlobalScopes([Post::published])->where(Post::slug, $post)->first();
            $author_model = $post_model?->authors->first();
        }

        return view('pages.admin.posts.form', [
            self::post_model => $post_model,
            self::author_model => $author_model
        ]);
    }
}
