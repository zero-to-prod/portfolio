<?php

namespace Tests\Feature\Routes;

use App\Helpers\Middlewares;
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
                to()->read->name,
                to()->file->name,
                to()->logo->name,
                to()->register->notice->name,
                to()->register->verification->name,
                to()->auth->github->index->name,
                to()->auth->github->callback->name,
                to()->auth->google->index->name,
                to()->auth->google->callback->name,
                to()->subscribe_addPassword->name,
                'feeds.main'
            ];

            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
