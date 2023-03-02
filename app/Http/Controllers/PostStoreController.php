<?php

namespace App\Http\Controllers;

use App\Http\Routes;
use App\Http\Views;
use App\Models\Author;
use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Upload;

class PostStoreController extends Controller
{
    /**
     * @throws Throwable
     * @see ConnectStoreControllerTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            Post::id => 'nullable|integer',
            Post::title => Post::rules(Post::title),
            Author::name => Author::rules(Author::name),
            Post::body => Post::rules(Post::body),
            'file' => 'nullable|image'
        ]);

        DB::transaction(static function () use ($request, $validated) {
            $post = Post::updateOrCreate([Post::id => $request->id], [
                Post::title => $validated[Post::title],
                Post::body => $validated[Post::body],
            ]);

            if ($request->hasFile('file')) {
                $file = Upload::file($request->file('file'));
                $file?->attachTags(['featured']);
                $post->files()->sync([$file?->id]);
            }

            $post->authors()->attach(Author::find($validated[Author::name]));

            $post->save();
        });

        return redirect_as(Routes::admin_posts);
    }
}
