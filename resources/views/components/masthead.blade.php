@props(['tags'])

<?php

use App\Helpers\R;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;

$search = SearchRedirect::search;

?>
<header class="fixed top-0 z-50 mx-auto w-full bg-primary-content">
    <div class="flex justify-between">
        <button id="toggle-navbar-btn"
                class="hidden btn-ghost min-[1312px]:block"
                aria-label="Menu"
                type="button">
            <x-svg :name="'hamburger'" class="m-auto block h-6 w-[64px]"/>
        </button>
        <x-a class="flex py-4 px-2 mr-2 text-lg 2col:text-xl btn-ghost" :href="R::welcome()">
            <span class="font-semibold text-primary">dev</span>READ
        </x-a>
        <div class="mx-auto w-full max-w-2xl 2col:pr-0 pr-2 my-auto">
            <form action="{{R::search()}}" method="post">
                @csrf
                <label for="{{$search}}"></label>
                <div class="flex rounded-md relative">
                    <div class="relative flex flex-grow focus-within:z-10">
                        <input class="block w-full appearance-none rounded-none rounded-l-md border-0 pl-4 ring-1 ring-inset ring-gray-300 h-[40px] py-1.5 focus:ring-2 focus:ring-inset focus:ring-primary"
                               name="{{$search}}"
                               id="{{$search}}"
                               value="{{request()->query(ResultsView::query)}}"
                               placeholder="Search">
                    </div>
                    <div class="absolute hidden 2col:flex inset-y-0 right-14 flex py-1.5 pr-1.5">
                        <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs">Press
                            ( / )
                        </kbd>
                    </div>
                    <button class="relative 2col:px-4 -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 btn-ghost"
                            aria-label="Search">
                        <x-svg :name="'search'" class="!h-5 !w-5"/>
                    </button>
                </div>
            </form>
        </div>
        <x-a :href="R::connect()" class="2col:block hidden py-4 px-2 ml-2 btn-ghost text-lg">Contact</x-a>
    </div>
</header>
@vite('resources/js/masthead.js')