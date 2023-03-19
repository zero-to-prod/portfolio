<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RegisterNoticeView extends Controller
{

    public function __invoke(): View|Factory|Application
    {
        return view_as(Views::register_notice);
    }
}
