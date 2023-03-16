<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ReadView;
use App\Jobs\ViewCounter;
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
        $post = $request->route(ReadView::post);

        if ($this->shouldIncrementView($request, $post)) {
            ViewCounter::dispatch($post, $request->ip(), $request->userAgent());
        }

        return $next($request);
    }

    protected function shouldIncrementView(Request $request, Post|string|null $post): bool
    {
        return $post instanceof Post && route_is(to()->web->read);
    }
}
