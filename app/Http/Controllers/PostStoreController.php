<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Upload;

class PostStoreController extends Controller
{
    /**
     * @throws \Throwable
     * @see ConnectStoreControllerTest
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            Post::title => Post::rules(Post::title),
            Author::name => Author::rules(Author::name),
            Post::body => Post::rules(Post::body),
            'file' => 'required|image'
        ]);

        DB::transaction(static function () use ($request, $validated) {
            $post = Post::create([
                Post::title => $validated[Post::title],
                Post::body => $validated[Post::body],
            ]);

            $file = Upload::file($request->file('file'));
            $file?->attachTags(['featured']);

            $post->files()->attach($file);

            $post->authors()->attach(Author::find($validated[Author::name]));

            $post->save();
        });

        return redirect()->back();
    }
}
