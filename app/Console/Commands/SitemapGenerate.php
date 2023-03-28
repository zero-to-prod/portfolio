<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class SitemapGenerate extends Command
{
    public const signature = 'sitemap:generate';
    protected $signature = self::signature;
    protected $description = 'Generates the sitemap';

    public function handle(): int
    {
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
