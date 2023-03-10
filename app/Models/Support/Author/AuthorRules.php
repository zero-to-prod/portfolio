<?php

namespace App\Models\Support\Author;

trait AuthorRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::name => ['required', 'max:255'],
            self::title => ['required', 'max:255'],
            default => [],
        };
    }
}
