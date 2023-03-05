<?php

namespace App\Http\Middleware;

use App\Http\Routes;
use App\Models\Post;
use App\Models\View;
use Closure;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostViewCounter
{

    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (route_is(Routes::read)) {
            DB::transaction(static function () use ($request) {
                /** @var Post $post */
                $post = $request->route('post');

                $post->increment(Post::views);

                View::create([
                    View::post_id => $post->id,
                    View::ip => $request->ip(),
                    View::user_agent => $request->userAgent(),
                    View::locale => app()->getLocale(),
                ]);
            });
        }

        return $next($request);
    }
}
