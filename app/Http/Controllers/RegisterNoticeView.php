<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RegisterNoticeView extends Controller
{

    public function __invoke(Request $request): View|Factory|Application
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return view_as(Views::register_notice);
    }
}
