<?php

namespace App\Models\Support\Message;

trait MessageRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::subject => ['required', 'max:255'],
            self::body => ['nullable', 'max:1000'],
            default => [],
        };
    }
}
