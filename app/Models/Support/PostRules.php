<?php

namespace App\Models\Support;

trait PostRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::title => ['required', 'max:60'],
            self::body => ['required'],
            default => [],
        };
    }
}
