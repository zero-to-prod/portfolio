<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class PostPublishController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            Post::id => 'nullable|integer',
        ]);

        DB::transaction(static function () use ($validated) {
            $post = Post::findOrFail($validated[Post::id]);

            $post->publish();
        });

        return redirect()->back();
    }
}
