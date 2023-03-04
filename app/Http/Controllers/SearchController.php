<?php

namespace App\Http\Controllers;

use App\Http\Routes;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Image;
use Storage;
use Str;

class SearchController extends Controller
{
    public const search = 'search';
    public function __invoke(Request $request): Redirector|RedirectResponse|Application
    {
        return redirect()->routeAs(Routes::results, [ResultsController::query => $request->search]);
    }
}
