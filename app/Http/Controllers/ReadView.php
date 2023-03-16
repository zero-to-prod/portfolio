<?php

namespace App\Http\Controllers;

use App\Helpers\CacheKeys;
use App\Helpers\Views;
use App\Models\Post;
use App\Models\User;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReadView extends Controller
{

    public const post = 'post';
    public const token = 'token';

    public function __invoke(Post $post): View|Factory|Application
    {
        $token = Cache::remember(CacheKeys::newsletter->value, 60 * 60 * 24, static function () {
            return User::first()?->createToken(CacheKeys::newsletter->value)->plainTextToken;
        });

        return view_as(Views::read_post, [self::post => $post, self::token => $token]);
    }
}
