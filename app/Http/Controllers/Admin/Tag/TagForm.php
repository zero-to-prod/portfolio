<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Helpers\Views;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagForm extends Controller
{
    public const tag = 'tag';

    public function __invoke(Request $request): View|Factory|Application
    {
        return view_as(Views::admin_tag_form, [self::tag => Tag::find($request->{self::tag})]);
    }
}
