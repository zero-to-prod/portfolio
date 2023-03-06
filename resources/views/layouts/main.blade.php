<?php

use App\Helpers\Routes;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\SearchController;

$search = SearchController::search;
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
                <button type="button" class="hover:bg-gray-200">
                    <svg class="block h-6 w-[64px] m-auto " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
                <a class="flex p-4 text-lg" href="{{route_as(Routes::welcome)}}">
                    <span class="font-semibold text-sky-600">dev</span>READ
                </a>
            </div>
            <div class="mx-auto w-full max-w-2xl py-2">
                <form action="{{route_as(Routes::search)}}" method="post">
                    @csrf
                    <label for="{{$search}}"></label>
                    <div class="flex rounded-md">
                        <div class="relative flex flex-grow focus-within:z-10">
                            <input class="w-full rounded-l-md pl-4 placeholder:text-gray-400 text-gray-900 ring-1 ring-inset ring-gray-300 h-[40px]"
                                   name="{{$search}}"
                                   id="{{$search}}"
                                   value="{{request()->query(ResultsController::query)}}"
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
            <div class="2col:block hidden p-4">About</div>
            <div class="flex 2col:hidden items-center px-4">
                <button type="button"
                        class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500"
                        aria-expanded="false">
                    <span class="sr-only">Open menu</span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <div class="mt-[64px]">
        {{$slot}}
    </div>
</main>
</body>
</html>
