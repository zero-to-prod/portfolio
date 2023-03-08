<?php

use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;
use App\Models\Tag;

$search = SearchRedirect::search;
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
    <header class="fixed top-0 z-50 mx-auto w-full bg-white">
        <div class="flex justify-between">
            <div class="flex">
                <button class="hidden min-[1312px]:block hover:bg-gray-200" id="toggle-navbar-btn" type="button">
                    <svg class="block h-6 w-[64px] m-auto " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
                <a class="flex p-4 px-2 2col:pl-4 text-lg" href="{{route_as(Routes::welcome)}}">
                    <span class="font-semibold text-sky-600">dev</span>READ
                </a>
            </div>
            <div class="mx-auto max-w-2xl py-2 w-full pr-2 2col:pr-0">
                <form action="{{route_as(Routes::search)}}" method="post">
                    @csrf
                    <label for="{{$search}}"></label>
                    <div class="flex rounded-md ">
                        <div class="relative flex flex-grow focus-within:z-10">
                            <input class="h-[40px] block w-full rounded-none rounded-l-md border-0 py-1.5 pl-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   name="{{$search}}"
                                   id="{{$search}}"
                                   value="{{request()->query(ResultsView::query)}}"
                                   placeholder="Search">
                        </div>
                        <button class="-ml-px rounded-r-md bg-gray-100 p-2 2col:px-4 ring-1 ring-inset ring-gray-300 hover:bg-gray-200">
                            <svg class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <a href="{{route_as(Routes::connect)}}" class="2col:block hidden p-4 text-gray-700">Contact</a>
        </div>
    </header>
    <div class="mt-[60px]">
        <x-left-drawer :tags="Tag::mostViewed()"/>
        <div id="content" class="ml-0 2col:px-4 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]">
            {{$slot}}
        </div>
    </div>
    <nav class="fixed 2col:hidden w-full bg-white bottom-0 bottom-0 left-0" id="left-nav-narrow">
        <div class="grid grid-cols-3">
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
               href="{{R::welcome()}}">
                <svg class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" aria-hidden="true">
                    <g>
                        <path d="M4,10V21h6V15h4v6h6V10L12,3Z"></path>
                    </g>
                </svg>
                <span class="text-xs mx-auto">Home</span>
            </a>
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_popular()}}">
                <svg class="h-6 w-6 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <g>
                        <path fill="none" d="M0 0H24V24H0z"></path>
                        <path d="M5 3v16h16v2H3V3h2zm14.94 2.94l2.12 2.12L16 14.122l-3-3-3.94 3.94-2.12-2.122L13 6.88l3 3 3.94-3.94z"></path>
                    </g>
                </svg>
                <span class="text-xs mx-auto">Popular</span>
            </a>
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_topics()}}">
                <svg class="h-6 w-6 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                    <defs></defs>
                    <path d="M22.707,9.2931a.9992.9992,0,0,0-1.0234-.2417l-9,3a1.001,1.001,0,0,0-.6323.6323l-3,9a1,1,0,0,0,1.2651,1.2651l9-3a1.0013,1.0013,0,0,0,.6323-.6324l3-9A1,1,0,0,0,22.707,9.2931ZM11.5811,20.419l2.2094-6.6284L18.21,18.21Z"></path>
                    <path d="M16,30A14,14,0,1,1,30,16,14.0158,14.0158,0,0,1,16,30ZM16,4A12,12,0,1,0,28,16,12.0137,12.0137,0,0,0,16,4Z"></path>
                    <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32"
                          height="32" style="fill: none"></rect>
                </svg>
                <span class="text-xs mx-auto">Topics</span>
            </a>
        </div>
    </nav>
</main>
<script>
    const toggleNavbarBtn = document.getElementById('toggle-navbar-btn');
    const navbarWide = document.getElementById('left-nav-wide');
    const navbarNarrow = document.getElementById('left-nav-narrow');
    const content = document.getElementById('content');

    // Retrieve the stored toggle state from local storage
    const isNavbarWideOpen = JSON.parse(localStorage.getItem('isNavbarWideOpen'));

    // Set the initial toggle state based on the stored value
    const block = 'min-[1312px]:block';
    const hidden = 'min-[1312px]:hidden';
    const ml = 'min-[1312px]:ml-[238px]';
    if (isNavbarWideOpen) {
        navbarWide.classList.add(block);
        navbarNarrow.classList.add(hidden);
        content.classList.add(ml);
    } else {
        navbarWide.classList.remove(block);
        navbarNarrow.classList.remove(hidden);
        content.classList.remove(ml);
    }

    toggleNavbarBtn.addEventListener('click', () => {
        // Toggle the classes as before
        navbarWide.classList.toggle(block);
        navbarNarrow.classList.toggle(hidden);
        content.classList.toggle(ml);

        // Store the toggle state in local storage
        const isNavbarWideOpen = navbarWide.classList.contains(block);
        localStorage.setItem('isNavbarWideOpen', JSON.stringify(isNavbarWideOpen));
    });
</script>
</body>
</html>

