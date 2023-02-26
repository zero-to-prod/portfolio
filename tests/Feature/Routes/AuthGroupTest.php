<?php

namespace Routes;

use App\Http\Routes;
use App\Models\User;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class AuthGroupTest extends TestCase
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
        $this->get(route($route))->assertOk();
    }

    public function getRoutes(): array
    {
        return collect($this->getRouteList('auth_group'))->filter(function ($route) {
            $blacklist = [
                Routes::email_verificationNotice->name,
                Routes::email_verify->name,
            ];
            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
