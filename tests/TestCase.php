<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Support\RouteMethods;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RouteMethods;
}
