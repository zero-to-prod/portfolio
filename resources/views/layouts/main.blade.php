<?php

use App\Http\Routes;

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
    <div id="content">
        <header class="fixed top-0 z-50 w-full 2col:overflow-y-visible bg-white 2col:shadow shadow-lg h-[56px] min-[780px]:shadow-none">
            <div class="mx-auto pr-4">
                <div class="relative flex justify-between gap-2">
                    <a class="flex pl-4 text-lg" href="{{route_as(Routes::welcome)}}">
                        <div class="my-auto"><span class="font-semibold text-sky-600">dev</span>READ</div>
                    </a>
                    <div class="col-span-6 min-w-0 flex-1 min-[1312px]:ml-[150px]">
                        <div class="flex max-w-md items-center py-2">
                            <div class="w-full">
                                <label for="search" class="block text-sm font-medium leading-6 text-gray-900"></label>
                                <div class="flex rounded-md shadow-sm">
                                    <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                        <input name="search" id="search"
                                               class="block w-full rounded-none rounded-l-md border-0 pl-4 placeholder:text-gray-400 text-gray-900 ring-1 ring-inset ring-gray-300 h-[40px] focus:ring-1 focus:ring-inset focus:ring-sky-600"
                                               placeholder="Search">
                                    </div>
                                    <button type="button"
                                            class="relative -ml-px inline-flex items-center rounded-r-md bg-gray-100 p-2 2col:px-4 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 gap-x-1.5 hover:bg-gray-200">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex 2col:hidden items-center">
                        <!-- Mobile menu button -->
                        <button type="button"
                                class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500"
                                aria-expanded="false">
                            <span class="sr-only">Open menu</span>
                            <!--
                              Icon when menu is closed.

                              Menu open: "hidden", Menu closed: "block"
                            -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                            <!--
                              Icon when menu is open.

                              Menu open: "block", Menu closed: "hidden"
                            -->
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="mt-[64px] 2col:mt-[124px]">
            {{$slot}}
        </div>
    </div>
</main>
</body>
</html>
