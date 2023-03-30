<?php

use App\Models\Tag;
use Spatie\SchemaOrg\Schema;

?>
@props(['title', 'tags' => null, 'description' => null])
        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description ?? config('app.name') . ' is a web development source for news, articles, tutorials, and more.'}}">
    <meta name="robots" content="max-image-preview:large">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    <meta name="title" content="{{ $title ?? config('app.name', 'Home') }}">
    @vite(['resources/css/app.css'])
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Vite::asset('resources/images/favicon/site.webmanifest') }}">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "DevLeak Logo",
      "url": "{{config('app.url')}}",
      "logo": "{{ Vite::asset('resources/images/favicon/android-chrome-512x512.png') }}"
    }
    </script>
    <?php
        $site = Schema::webSite()->name(config('app.name'))->url(to()->welcome());
        echo $site->toScript();
    ?>
    @stack('data')
</head>
<body class="min-h-screen overflow-y-scroll antialiased bg-primary-content text-base-content">
<main class="min-h-[50vh]" aria-label="Main">
    <x-masthead/>
    <div class="mt-narrow-nav">
        <x-left-drawer :tags="$tags ?? Tag::getMostViewed()"/>
        <div id="content" class="ml-0 nav-small:ml-narrow-nav nav-wide:ml-wide-nav">
            {{$slot}}
        </div>
    </div>
    <x-bottom-mobile-nav/>
</main>
<x-footer/>
@vite(['resources/js/web.js'])
</body>
</html>

