<?php

namespace App\Models\Support;

trait PostRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::title => ['required', 'max:255'],
            self::body => ['required'],
            default => [],
        };
    }
}
