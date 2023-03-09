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
                <button aria-label="Menu"
                        class="hidden hover:bg-gray-200 min-[1312px]:block"
                        id="toggle-navbar-btn"
                        type="button">
                    <x-svg :name="'hamburger'" class="m-auto block h-6 w-[64px]"/>
                </button>
                <a class="flex p-4 px-2 2col:pl-4 text-lg hover:bg-gray-200" href="{{route_as(Routes::welcome)}}">
                    <span class="font-semibold text-sky-700">dev</span>READ
                </a>
            </div>
            <div class="mx-auto w-full max-w-2xl py-2 2col:pr-0 pr-2">
                <form action="{{route_as(Routes::search)}}" method="post">
                    @csrf
                    <label for="{{$search}}"></label>
                    <div class="flex rounded-md relative">
                        <div class="relative flex flex-grow focus-within:z-10">
                            <input class="block w-full appearance-none rounded-none rounded-l-md border-0 pl-4 placeholder:text-gray-400 text-gray-900 ring-1 ring-inset ring-gray-300 h-[40px] py-1.5 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   name="{{$search}}"
                                   id="{{$search}}"
                                   value="{{request()->query(ResultsView::query)}}"
                                   placeholder="Search">
                        </div>
                        <div class="absolute hidden 2col:flex inset-y-0 right-14 flex py-1.5 pr-1.5">
                            <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-500">Press ( / )</kbd>
                        </div>
                        <button class="relative 2col:px-4 -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-200"
                                aria-label="Search">
                            <x-svg :name="'search'" class="!h-5 !w-5"/>
                        </button>
                    </div>
                </form>
            </div>
            <a href="{{route_as(Routes::connect)}}" class="2col:block hidden p-4 hover:bg-gray-200 text-gray-700 text-lg">Contact</a>
        </div>
    </header>
    <div class="mt-[60px]">
        <x-left-drawer :tags="Tag::mostViewed()"/>
        <div id="content" class="mb-16 ml-0 2col:px-2 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]">
            {{$slot}}
        </div>
    </div>
    <nav class="fixed bottom-0 left-0 2col:hidden w-full bg-white" id="left-nav-narrow">
        <div class="grid grid-cols-3">
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
               href="{{R::welcome()}}">
                <x-svg :name="'home'" class="mx-auto"/>
                <span class="mx-auto text-xs">Home</span>
            </a>
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_popular()}}">
                <x-svg :name="'popular'" class="mx-auto"/>
                <span class="mx-auto text-xs">Popular</span>
            </a>
            <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_topics()}}">
                <x-svg :name="'topics'" class="mx-auto"/>
                <span class="mx-auto text-xs">Topics</span>
            </a>
        </div>
    </nav>
</main>
<script>
    const handleKeyDown = (event) => {
        const { key, target } = event;
        const searchInput = document.getElementById("search");

        if (key === "/" && target.tagName !== "INPUT") {
            searchInput.focus();
            event.preventDefault();
        } else if (key === "Escape" && target === searchInput) {
            searchInput.blur();
            event.preventDefault();
        }
    };

    document.addEventListener("keydown", handleKeyDown);


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

