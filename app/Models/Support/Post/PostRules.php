<?php

namespace App\Models\Support\Post;

trait PostRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::title => ['required', 'max:60'],
            self::subtitle => ['nullable', 'max:150'],
            self::public_content => ['nullable'],
            self::cta => ['nullable'],
            self::exclusive_content => ['nullable'],
            default => [],
        };
    }
}
