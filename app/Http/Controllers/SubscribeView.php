<?php

namespace App\Http\Controllers;

use App\Helpers\CacheKeys;
use App\Helpers\Views;
use App\Models\Tag;
use App\Models\User;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubscribeView extends Controller
{
    public const token = 'token';
    public const tags = 'tags';
    public function __invoke(): View|Factory|Application
    {
        $token = Cache::rememberAs(CacheKeys::newsletter, 60 * 60 * 24, static function () {
            return User::first()?->createToken(CacheKeys::newsletter->value)->plainTextToken;
        });

        return view_as(Views::subscribe, [self::tags => Tag::mostViewed(limit: 5), self::token => $token]);
    }
}
