<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\Admin\Post;

use App\Helpers\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Post;
use Cache;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Upload;

class PostStore extends Controller
{
    public const id = 'id';
    public const title = 'title';
    public const type = 'type';
    public const subtitle = 'subtitle';
    public const authors = 'authors[]';
    public const tags = 'tags[]';
    public const public_content = 'public_content';
    public const cta = 'cta';
    public const exclusive_content = 'exclusive_content';
    public const featured_image = 'featured_image';
    public const alt_image = 'alt_image';
    public const animation_image = 'animation_image';
    public const in_body = 'in_body';

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
            self::type => 'nullable',
            self::title => Post::rules(Post::title),
            self::subtitle => Post::rules(Post::subtitle),
            'authors' => 'required|array|min:1',
            'tags' => 'required|array|min:1',
            self::public_content => Post::rules(Post::public_content),
            self::cta => Post::rules(Post::cta),
            self::exclusive_content => Post::rules(Post::exclusive_content),
            self::featured_image => 'nullable|image',
            self::alt_image => 'nullable|image',
            self::animation_image => 'nullable|image',
            self::in_body => 'nullable|image',
        ]);

        DB::beginTransaction();

        $post = Post::withoutGlobalScopes([Post::published])->updateOrCreate([Post::id => $request->{self::id}], [
            Post::post_type_id => $validated[self::type],
            Post::title => $validated[self::title],
            Post::subtitle => $validated[self::subtitle],
            Post::public_content => $validated[self::public_content],
            Post::cta => $validated[self::cta],
            Post::exclusive_content => $validated[self::exclusive_content],
        ]);

        if ($request->hasFile(self::featured_image)) {
            $featured_image = File::upload($request->file(self::featured_image));
            $featured_image?->tagFeaturedImage();
            $post->file_id = $featured_image?->id;
            $post->save();
        }
        if ($request->hasFile(self::animation_image)) {
            $animation_image = File::upload($request->file(self::animation_image));
            $animation_image?->tagAltFile();
            $post->animation_file_id = $animation_image?->id;
            $post->save();
        }
        if ($request->hasFile(self::alt_image)) {
            $alt_image = File::upload($request->file(self::alt_image));
            $alt_image?->tagAltFile();
            $post->alt_file_id = $alt_image?->id;
            $post->save();
        }

        if ($request->hasFile(self::in_body)) {
            $in_body = File::upload($request->file(self::in_body));
            $in_body?->tagInBodyImage();
            $post->files()->syncWithoutDetaching([$in_body?->id]);
        }

        $post->authors()->sync($validated['authors']);
        Cache::forget($post->id . '|' . CacheKeys::post_author_list->value);
        $post->tags()->sync($validated['tags']);

        if ($post->file === null) {
            return redirect()->back()->withErrors([self::featured_image => 'Missing Image'])->withInput();
        }

        $post->save();

        DB::commit();

        return redirect()->to(to()->admin->post->edit($post));
    }
}
