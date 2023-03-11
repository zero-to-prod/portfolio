<?php

namespace App\Models\Support\Tag;

trait TagRules
{
    public static function rules(string $column): array
    {
        return match ($column) {
            self::name => ['required', 'max:15', 'unique:tags,name'],
        };
    }
}
