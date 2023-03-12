<?php

namespace Routes;

use App\Helpers\AdminRoutes;
use App\Helpers\AuthRoutes;
use App\Helpers\Middlewares;
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
        return collect($this->getRouteList(Middlewares::auth_group))->filter(function ($route) {
            $blacklist = [
                AuthRoutes::email_verificationNotice->name,
                AuthRoutes::email_verify->name,
                AdminRoutes::post_edit->name,
                AdminRoutes::tag_edit->name,
                AdminRoutes::author_edit->name,
                AdminRoutes::post_index->name,
                AdminRoutes::post_create->name,
            ];
            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
