<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Upload;

class PostFormRedirect extends Controller
{
    public const id = 'id';
    public const title = 'title';
    public const subtitle = 'subtitle';
    public const authors = 'authors[]';
    public const tags = 'tags[]';
    public const body = 'body';
    public const featured_image = 'featured_image';
    public const in_body = 'in_body';

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
            self::title => Post::rules(Post::title),
            self::subtitle => Post::rules(Post::subtitle),
            'authors' => 'required|array|min:1',
            'tags' => 'required|array|min:1',
            self::body => Post::rules(Post::body),
            self::featured_image => 'nullable|image',
            self::in_body => 'nullable|image',
        ]);

        DB::beginTransaction();

        $post = Post::withoutGlobalScopes([Post::published])->updateOrCreate([Post::id => $request->{self::id}], [
            Post::title => $validated[self::title],
            Post::subtitle => $validated[self::subtitle],
            Post::body => $validated[self::body],
        ]);

        if ($request->hasFile(self::featured_image)) {
            $featured_image = File::upload($request->file(self::featured_image));
            $featured_image?->tagFeaturedImage();
            $post->files()->sync([$featured_image?->id]);
        }

        if($request->hasFile(self::in_body)) {
            $in_body = File::upload($request->file(self::in_body));
            $in_body?->tagInBodyImage();
            $post->files()->syncWithoutDetaching([$in_body?->id]);
        }

        $post->authors()->sync($validated['authors']);
        $post->tags()->sync($validated['tags']);

        if ($post->isMissingFeaturedImage()) {
            return redirect()->back()->withErrors([self::featured_image => 'Missing Image'])->withInput();
        }

        $post->save();

        DB::commit();

        return redirect()->to(to()->admin->post->edit($post));
    }
}
