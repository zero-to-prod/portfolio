<?php

namespace Tests\Feature\CV;

use App\Http\Routes;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /* @test */
    public function welcome(): void
    {
        $this->getAs(Routes::cv)->assertOk();
    }
}
