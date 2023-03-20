<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class PostPublish extends Controller
{
    public const id = 'id';
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
        ]);

        DB::transaction(static function () use ($validated) {
            $post = Post::withoutGlobalScopes([Post::published])->findOrFail($validated[self::id]);

            $post->publish();
        });

        return redirect()->back();
    }
}
