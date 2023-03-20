<?php

namespace Routes;

use App\Helpers\Middlewares;
use App\Helpers\Roles;
use Spatie\Permission\Models\Role;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class AuthGroupTest extends TestCase
{
    use GetRouteList;

    public function setUp(): void
    {
        parent::setUp();
        Role::create(['name' => Roles::super_admin->value]);
        $this->be(user()->assignRole(Roles::super_admin->value));
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
                to()->register->verification->name,
                to()->admin->author->edit->name,
                to()->admin->tag->edit->name,
                to()->admin->post->edit->name,
                to()->admin->post->index->name,
                to()->admin->post->create->name,
            ];
            return !in_array($route[0], $blacklist, true);
        })->toArray();
    }
}
