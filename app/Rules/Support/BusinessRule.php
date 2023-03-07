<?php

namespace App\Rules\Support;

interface BusinessRule
{
    public function handle(): bool;
}