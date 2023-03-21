<?php

use App\Models\Tag;
?>
@props(['title', 'tags' => null])

        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DevNachos dev leak">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
    <livewire:styles />
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
<livewire:scripts />
@vite(['resources/js/web.js'])
</body>
</html>

