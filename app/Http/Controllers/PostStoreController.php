<?php

namespace App\Http\Controllers;

use App\Helpers\Tags;
use App\Http\Routes;
use App\Models\Author;
use App\Models\Post;
use DB;
use Illuminate\Http\Request;
use Throwable;
use Upload;

class PostStoreController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            Post::id => 'nullable|integer',
            Post::title => Post::rules(Post::title),
            Author::name => Author::rules(Author::name),
            Post::body => Post::rules(Post::body),
            'file' => 'nullable|image'
        ]);

        DB::beginTransaction();

        $post = Post::updateOrCreate([Post::id => $request->id], [
            Post::title => $validated[Post::title],
            Post::body => $validated[Post::body],
        ]);

        if ($request->hasFile('file')) {
            $file = Upload::file($request->file('file'));
            $file?->attachTags([Tags::featured->value]);
            $post->files()->sync([$file?->id]);
        }

        $post->authors()->attach(Author::find($validated[Author::name]));

        if ($post->featuredImage() === null) {
            return redirect()->back()->withErrors(['file' => 'Missing Image'])->withInput();
        }

        $post->save();

        DB::commit();

        return redirect()->to(route_as(Routes::admin_posts_edit, $post));
    }
}
