<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Str;

class SitemapGenerate extends Command
{
    public const signature = 'sitemap:generate';
    protected $signature = self::signature;
    protected $description = 'Generates the sitemap';

    public function handle(): int
    {
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                if (Str::contains($url->path(), '/auth', true)) {
                    return;
                }

                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
