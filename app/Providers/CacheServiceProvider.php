<?php

namespace App\Providers;

use DateInterval;
use DateTimeInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Cache;

class CacheServiceProvider extends ServiceProvider
{
    protected bool $defer = true;
    public function boot(): void
    {
        $this->registerHasView();
        $this->registerGetView();
        $this->registerPutView();
    }

    /**
     * Registers additional method on the Cache Facade.
     *  - hasView(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum name is used as the cache key
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerHasView(): void
    {
        Cache::macro('hasView', function (array|string|\UnitEnum $key) {
            return $key instanceof \UnitEnum ? Cache::has($key->name) : Cache::has($key);
        });
    }

    /**
     * Registers additional method on the Cache Facade.
     *  - getView(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum name is used as the cache key
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerGetView(): void
    {
        Cache::macro('getView', function (array|string|\UnitEnum $key, $default = null) {
            return $key instanceof \UnitEnum ? Cache::get($key->name, $default) : Cache::get($key, $default);
        });
    }

    /**
     * Registers additional method on the Cache Facade.
     *  - putView(...$args)
     *
     * If an Enum is passed for the first argument:
     *  - the Enum name is used as the cache key
     *
     * If no Enum is passed, behavior is not modified.
     */
    protected function registerPutView(): void
    {
        Cache::macro('putView', function (array|string|\UnitEnum $key, mixed $value, DateTimeInterface|DateInterval|int|null $ttl = null) {
            return $key instanceof \UnitEnum ? Cache::put($key->name, $value, $ttl) : Cache::put($key, $value, $ttl);
        });
    }
}
