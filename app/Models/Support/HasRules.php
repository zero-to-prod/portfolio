<?php

namespace App\Models\Support;

interface HasRules
{
    public static function rules(string $column): array;
}
