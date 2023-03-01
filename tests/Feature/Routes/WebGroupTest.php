<?php

namespace Tests\Feature\Routes;

use App\Http\Middleware;
use App\Http\Routes;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class WebGroupTest extends TestCase
{
    use GetRouteList;

    /**
     * @test
     * @dataProvider getRoutes
     */
    public function check_each_route(string $route): void
    {
        $this->get(route($route))->assertOk();
    }

    public function getRoutes(): array
    {
        return collect($this->getRouteList(Middleware::web_group))->filter(function ($route) {
            $blacklist = [Routes::blog_post->name];
            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
