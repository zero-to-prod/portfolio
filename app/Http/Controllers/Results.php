<?php

namespace App\Http\Controllers;

use App\Helpers\TagTypes;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Results extends Controller
{
    public const query = 'query';
    public const topic = 'topic';
    public const tag = 'tag';
    public const author_model = 'author_model';
    public const topics = 'topics';
    public const popular = 'popular';
    public const posts = 'posts';
    public const author = 'author';
    public const limit = 20;

    public function __invoke(Request $request): View|Factory|Application
    {
        $posts = null;
        $tag = null;
        $search = $request->query(self::query);
        $tag_name = $request->query(self::topic);
        $popular = $request->query(self::popular);
        $author = $request->query(self::author);
        $author_model = null;

        if ($search !== null) {
            $posts = Post::where(static function (Builder $query) use ($search) {
                $query->whereFullText(Post::title, $search)
                    ->orWhereFullText(Post::public_content, $search);
            })
                ->with([Post::tags, Post::authors, Post::file, Post::tags . '.' . Tag::file])
                ->orderByDesc(Post::views)
                ->limit(self::limit)
                ->get();

            $related = Post::related($posts->pluck(Post::tags)->flatten(), $posts->pluck(Post::id)->toArray(), limit: self::limit)->get();
            $posts = $posts->merge($related);
        }

        if ($tag_name !== null) {
            $posts = Post::related($tag_name, limit: self::limit)->get();
            $tag = Tag::withType(TagTypes::post->value)->where(Tag::slug . '->en', $tag_name)->first();
        }

        if ($popular !== null) {
            $posts = Post::with([Post::tags . '.' . Tag::file, Post::authors, Post::file])
                ->orderByDesc(Post::views)
                ->limit(self::limit)
                ->get();
        }

        if ($author !== null) {
            $posts = Post::with([Post::tags, Post::authors])
                ->whereHas(Post::authors, static function (Builder $query) use ($author) {
                    $query->where(Author::slug, $author);
                })
                ->with([Post::file, Post::tags . '.' . Tag::file])
                ->orderByDesc(Post::views)
                ->limit(self::limit)
                ->get();

            $latest = $posts->filter(fn($post) => $post->original_publish_date->isToday());
            $posts = $latest->merge($posts);
            $author_model = Author::where(Author::slug, $author)->first();
        }

        return view('pages.results', [
            self::posts => $posts,
            self::tag => $tag,
            self::author_model => $author_model,
        ]);
    }
}
