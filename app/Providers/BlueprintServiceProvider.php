<?php
/**
 * @noinspection PhpUndefinedMethodInspection
 */

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Fluent;

class BlueprintServiceProvider extends ServiceProvider
{
    protected bool $defer = true;

    public function boot(): void
    {
        $this->registerSlug();
        $this->registerName();
    }

    protected function registerSlug(): void
    {
        Blueprint::macro('slug', function (string $column = 'slug', ?int $length = null): ColumnDefinition {
            return $this->char($column, $length)->unique();
        });

        Blueprint::macro('dropSlug', function (?string $column = null): Fluent {
            $this->dropUnique([$column]);
            return $this->dropColumn($column);
        });
    }

    protected function registerName(): void
    {
        Blueprint::macro('name', function (string $column = 'name', int|null $length = null): ColumnDefinition {
            return $this->char($column, $length);
        });
    }
}
