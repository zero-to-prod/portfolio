<?php

namespace App\Http\Middleware;

use App\Models\View;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostViewCounter
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('blog/*')) {
            View::create([
                View::post_id => $request->route('post')->id,
                View::ip => $request->ip(),
                View::user_agent => $request->userAgent(),
                View::locale => app()->getLocale(),
            ]);
        }

        return $next($request);
    }
}
