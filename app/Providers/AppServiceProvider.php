<?php
/**
 * @noinspection PhpUndefinedClassInspection
 * @noinspection StaticClosureCanBeUsedInspection
 */

namespace App\Providers;

use App;
use App\Helpers\Environments;
use App\Helpers\Relations;
use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Tests\Feature\Macros\App\EnvironmentAsTest;
use UnitEnum;
use URL;

class AppServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        if($this->app->environment(Environments::production->value))
        {
            URL::forceScheme('https');
        }

        Model::preventLazyLoading(!$this->app->isProduction());

        Relation::enforceMorphMap([
            Relations::user->value => User::class,
            Relations::post->value => Post::class,
            Relations::file->value => File::class,
            Relations::author->value => Author::class,
            Relations::tag->value => Tag::class,
            Relations::react->value => Reaction::class,
        ]);

        $this->registerEnvironmentAs();
    }

    /**
     * @see EnvironmentAsTest
     */
    protected function registerEnvironmentAs(): void
    {
        App::macro('environmentAs', function (...$environments) {
            $firstArg = reset($environments);
            if ($firstArg instanceof UnitEnum && count($environments) > 0) {
                return App::environment($firstArg->value);
            }

            return App::environment(...$environments);
        });
    }
}
