<?php

namespace App\Http\Controllers;

use App\Helpers\Views;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReadView extends Controller
{

    public const post = 'post';

    public function __invoke(Post $post): View|Factory|Application
    {
        return view_as(Views::read_post, [self::post => $post]);
    }
}
