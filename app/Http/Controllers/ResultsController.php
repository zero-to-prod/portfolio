<?php

namespace App\Http\Controllers;

use App\Http\Routes;
use App\Http\Views;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ResultsController extends Controller
{
    public const query = 'query';
    public function __invoke(Request $request): View|Factory|Application
    {
        $search = $request->query(self::query);


        $posts = Post::where('title', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->with(['tags', 'authors'])
            ->withCount('views')
            ->orderByDesc('views_count')
            ->get();

        $recommended = Post::recommended($posts->pluck('tags')->flatten(), $posts->pluck('id')->toArray());

        return view_as(Views::results, ['posts' => $posts->merge($recommended)]);
    }
}
