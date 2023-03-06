<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WelcomeView extends Controller
{

    public const tags = 'tags';

    public function __invoke(): View|Factory|Application
    {
        return view_as(Views::welcome, [self::tags => Tag::mostViewed()]);
    }
}
