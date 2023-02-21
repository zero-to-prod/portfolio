<?php

namespace App\Models\Support;

trait ContactRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::email => ['required', 'email:rfc,dns'],
            default => [],
        };
    }
}
