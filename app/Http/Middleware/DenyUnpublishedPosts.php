<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ReadView;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Middleware\DenyUnpublishedPostsTest;
use Symfony\Component\HttpFoundation\Response;

class DenyUnpublishedPosts
{

    /**
     * @see DenyUnpublishedPostsTest
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route(ReadView::post);

        if ($post instanceof Post && $post->isNotPublished() && route_is(to()->read)) {
            abort(404);
        }

        return $next($request);
    }
}
