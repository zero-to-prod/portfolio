<?php

namespace Routes;

use App\Http\Routes;
use App\Models\User;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class RegisterGroupTest extends TestCase
{
    use GetRouteList;

    public function setUp(): void
    {
        parent::setUp();
        $this->be(User::factory()->create());
    }

    /**
     * @test
     * @dataProvider getRoutes
     */
    public function check_each_route(string $route): void
    {
        $this->get(route($route))->assertRedirect();
    }

    public function getRoutes(): array
    {
        return collect($this->getRouteList('register_group'))->filter(function ($route) {
            $blacklist = [Routes::passwordNew_create->name];
            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
