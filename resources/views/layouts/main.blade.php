<?php

use App\Models\Tag;

?>
@props(['title', 'tags' => null, 'description' => null])
        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description ?? 'Stay up to date with the latest in web development.'}}">
    <meta name="robots" content="nofollow">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Vite::asset('resources/images/favicon/site.webmanifest') }}">
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

