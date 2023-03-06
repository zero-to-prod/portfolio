<?php

namespace App\Http\Middleware;

use App\Helpers\Routes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenyUnpublishedPosts
{

    public function handle(Request $request, Closure $next): Response
    {
        if (route_is(Routes::read) && $request->route('post')?->published_at === null) {
            abort(404);
        }

        return $next($request);
    }
}
