<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\Authenticate;
use Tests\Support\GetRouteList;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use GetRouteList;

    /**
     * @test
     * @see Authenticate
     */
    public function redirects_to_login_when_log_logged_in(): void
    {
        $this->get(to()->admin->dashboard())->assertRedirect(to()->login->index());
    }

    /**
     * @test
     * @see Authenticate
     */
    public function does_not_redirect_for_json_request(): void
    {
        $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'])
            ->get(to()->admin->dashboard->value)
            ->assertJson([]);
    }
}
