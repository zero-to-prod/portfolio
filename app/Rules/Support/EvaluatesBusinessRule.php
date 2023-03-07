<?php

namespace App\Rules\Support;

trait EvaluatesBusinessRule
{
    public static function evaluate(): bool
    {
        return (new static(...func_get_args()))->handle();
    }
}