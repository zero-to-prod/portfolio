<?php

namespace App\Http\Controllers;

use App\Helpers\Routes;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SearchRedirect extends Controller
{
    public const search = 'search';
    public function __invoke(Request $request): Redirector|RedirectResponse|Application
    {
        return redirect()->routeAs(Routes::results, [ResultsView::query => $request->{self::search}]);
    }
}
