<?php

namespace App\Http\Controllers\Admin\Tag;

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
        return view('pages.admin.tags.form', [self::tag => Tag::find($request->{self::tag})]);
    }
}
