<?php

namespace Tests\Feature\Routes;

use App\Helpers\Middlewares;
use App\Helpers\Routes;
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
        return collect($this->getRouteList(Middlewares::web_group))->filter(function ($route) {
            $blacklist = [
                Routes::read->name,
                Routes::file->name,
            ];

            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
