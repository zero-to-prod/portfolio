<?php

namespace App\Providers;

use App\Helpers\Relations;
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
            Relations::user->value => User::class,
            Relations::post->value => Post::class,
            Relations::file->value => File::class,
            Relations::author->value => Author::class,
            Relations::tag->value => Tag::class,
        ]);
    }
}
