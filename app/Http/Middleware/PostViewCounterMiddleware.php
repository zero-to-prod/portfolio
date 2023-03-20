<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Read;
use App\Jobs\PostViewCounterJob;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostViewCounterMiddleware
{

    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route(Read::post);

        if ($this->shouldIncrementView($request, $post)) {
            PostViewCounterJob::dispatch($post, $request->ip(), $request->userAgent());
        }

        return $next($request);
    }

    protected function shouldIncrementView(Request $request, Post|string|null $post): bool
    {
        return $post instanceof Post && route_is(to()->read);
    }
}
