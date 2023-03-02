<?php

namespace App\Http\Middleware;

use App\Http\Routes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenyUnpublishedPosts
{

    public function handle(Request $request, Closure $next): Response
    {
        if (route_is(Routes::blog_post) && $request->route('post')?->published_at === null) {
            abort(404);
        }
        return $next($request);
    }
}
