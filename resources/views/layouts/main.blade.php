<?php

use App\Models\Tag;

?>
@props(['title'])

        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="devREAD dev read">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
</head>
<body class="min-h-screen overflow-y-scroll">
<main aria-label="Main">
    <x-masthead/>
    <div class="mt-[60px]">
        <x-left-drawer :tags="Tag::mostViewed()"/>
        <div id="content" class="mb-16 ml-0 2col:px-2 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]">
            {{$slot}}
        </div>
    </div>
    <x-bottom-mobile-nav/>
</main>
</body>
</html>

