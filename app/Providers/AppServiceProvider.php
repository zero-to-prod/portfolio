<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;
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
            2 => Post::class,
            3 => File::class,
            4 => Author::class,
            5 => Tag::class,
        ]);
    }
}
