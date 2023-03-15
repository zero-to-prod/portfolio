<?php

use App\Models\Tag;

?>
@props(['title'])

        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="devRED dev red">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
</head>
<body class="min-h-screen overflow-y-scroll antialiased bg-primary-content text-base-content">
<main class="min-h-[50vh]" aria-label="Main">
    <x-masthead/>
    <div class="mt-[60px]">
        <x-left-drawer :tags="Tag::mostViewed()"/>
        <div id="content" class="ml-0 2col:px-2 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]">
            {{$slot}}
        </div>
    </div>
    <x-bottom-mobile-nav/>
</main>
<footer id="footer" class="mt-8 ml-0 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]"
        aria-labelledby="footer-heading">
    <h2 class="sr-only">Footer</h2>
    <div class="mx-auto max-w-7xl border-t 2col:p-0 p-4 2col:py-8 xl:grid xl:grid-cols-3 xl:gap-8">
        <div class="space-y-8">
            <x-a class="2col:block hidden" :href="to()->web->welcome()">
                <x-logo/>
            </x-a>
        </div>
        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-gray-900">Membership</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="{{to()->web->login()}}"
                               class="text-sm leading-6 text-gray-600 hover:text-gray-900">Login</a>
                        </li>
                        <li>
                            <a href="{{to()->web->subscribe()}}"
                               class="text-sm leading-6 text-gray-600 hover:text-gray-900">Newsletter</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-10 md:mt-0">
                    <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="{{to()->web->contact()}}"
                               class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-gray-900">Pages</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="{{to()->web->welcome()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Home</a>
                        </li>
                        <li>
                            <a href="{{to()->web->results()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Search</a>
                        </li>
                        <li>
                            <a href="{{to()->web->resultsPopular()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Popular</a>
                        </li>
                        <li>
                            <a href="{{to()->web->resultsTopics()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Topics</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-10 md:mt-0">
                    <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li>
                            <a href="{{to()->web->privacy()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{to()->web->tos()}}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms of Service</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto 2col:mb-0 mb-16 max-w-7xl border-t border-gray-900/10 2col:p-0 p-4 2col:py-8 py-8">
        <p class="text-xs leading-5 text-gray-500">&copy; {{date('Y')}} {{config('app.name')}}. All rights reserved.</p>
    </div>
</footer>
</body>
</html>

