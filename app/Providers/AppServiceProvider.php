<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Model::preventLazyLoading(!$this->app->isProduction());

        Relation::enforceMorphMap([
            1 => User::class,
            2 => Post::class
        ]);
    }
}
