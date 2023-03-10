@props(['tags'])

<?php

use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;

$search = SearchRedirect::search;

?>
<header class="fixed top-0 z-50 mx-auto w-full bg-primary-content">
    <div class="flex justify-between">
        <div class="flex">
            <button id="toggle-navbar-btn"
                    class="hidden hover:bg-gray-200 min-[1312px]:block"
                    aria-label="Menu"
                    type="button">
                <x-svg :name="'hamburger'" class="m-auto block h-6 w-[64px]"/>
            </button>
            <a class="flex p-4 text-lg hover:bg-gray-200" href="{{route_as(Routes::welcome)}}">
                <span class="font-semibold text-sky-700">dev</span>READ
            </a>
        </div>
        <div class="mx-auto w-full max-w-2xl py-2 2col:pr-0 pr-2">
            <form action="{{route_as(Routes::search)}}" method="post">
                @csrf
                <label for="{{$search}}"></label>
                <div class="flex rounded-md relative">
                    <div class="relative flex flex-grow focus-within:z-10">
                        <input class="block w-full appearance-none rounded-none rounded-l-md border-0 pl-4 placeholder:text-gray-500 text-gray-900 ring-1 ring-inset ring-gray-300 h-[40px] py-1.5 focus:ring-2 focus:ring-inset focus:ring-sky-600"
                               name="{{$search}}"
                               id="{{$search}}"
                               value="{{request()->query(ResultsView::query)}}"
                               placeholder="Search">
                    </div>
                    <div class="absolute hidden 2col:flex inset-y-0 right-14 flex py-1.5 pr-1.5">
                        <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-500">Press
                            ( / )
                        </kbd>
                    </div>
                    <button class="relative 2col:px-4 -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-800 ring-1 ring-inset ring-gray-300 hover:bg-gray-200"
                            aria-label="Search">
                        <x-svg :name="'search'" class="!h-5 !w-5"/>
                    </button>
                </div>
            </form>
        </div>
        <a href="{{route_as(Routes::connect)}}" class="2col:block hidden p-4 hover:bg-gray-200 text-gray-800 text-lg">Contact</a>
    </div>
</header>
@vite('resources/js/masthead.js')