<?php

namespace App\Http\Controllers;

use App\Http\Routes;
use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Upload;

class PostFormController extends Controller
{
    public const id = 'id';
    public const title = 'title';
    public const authors = 'authors[]';
    public const tags = 'tags[]';
    public const body = 'body';
    public const featured_image = 'featured_image';

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
            self::title => Post::rules(Post::title),
            'authors' => 'required|array|min:1',
            'tags' => 'required|array|min:1',
            self::body => Post::rules(Post::body),
            self::featured_image => 'nullable|image'
        ]);

        DB::beginTransaction();

        $post = Post::updateOrCreate([Post::id => $request->id], [
            Post::title => $validated[Post::title],
            Post::body => $validated[Post::body],
        ]);

        if ($request->hasFile(self::featured_image)) {
            $featured_image = Upload::file($request->file(self::featured_image));
            $featured_image?->tagFeaturedImage();
            $post->files()->sync([$featured_image?->id]);
        }

        $post->authors()->sync($validated['authors']);
        $post->tags()->sync($validated['tags']);

        if ($post->featuredImage() === null) {
            return redirect()->back()->withErrors([self::featured_image => 'Missing Image'])->withInput();
        }

        $post->save();

        DB::commit();

        return redirect()->to(route_as(Routes::admin_posts_edit, $post));
    }
}
