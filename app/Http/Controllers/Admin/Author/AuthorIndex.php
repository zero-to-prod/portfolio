<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorIndex extends Controller
{
    public const authors = 'authors';
    public const views = 'views';

    public function __invoke(Request $request): View|Factory|Application
    {
        return view('pages.admin.authors.index', [
            self::authors => Author::with(Author::file)->get(),
        ]);
    }
}
