<?php

namespace App\Http\Middleware;

use App\Helpers\Routes;
use App\Http\Controllers\ReadView;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenyUnpublishedPosts
{

    public function handle(Request $request, Closure $next): Response
    {
        /** @var Post $post */
        $post = $request->route(ReadView::post);
        if (is_a($post, Post::class) && $post->isNotPublished() && route_is(Routes::read)) {
            abort(404);
        }

        return $next($request);
    }
}
