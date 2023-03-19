@props(['tags'])

<?php

use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;

$search = SearchRedirect::search;

?>
<header id="masthead"
        class="fixed transition-all duration-500 top-0 z-50 mx-auto w-full bg-primary-content shadow 2col:shadow-none">
    <div class="flex justify-between 2col:gap-2">
        <button id="toggle-navbar-btn"
                class="hidden btn-ghost nav-wide:block"
                aria-label="Menu"
                title="Toggle Navigation"
                type="button">
            <x-svg :name="'hamburger'" class="m-auto block h-6 w-narrow-nav"/>
        </button>
        <x-a class="px-2 py-4 btn-ghost" :href="to()->web->welcome()" title="Home">
            <x-logo/>
        </x-a>
        <div class="my-auto w-full max-w-2xl mr-2 2col:mx-auto">
            <form action="{{to()->web->search()}}" method="post">
                @csrf
                <label for="{{$search}}"></label>
                <div class="relative flex rounded-md">
                    <div class="relative flex flex-grow focus-within:z-10">
                        <input class="block w-full appearance-none rounded-none rounded-l-md border-0 pl-4 ring-1 ring-inset ring-gray-300 h-[40px] py-1.5 focus:ring-primary focus:ring-2 focus:ring-inset"
                               name="{{$search}}"
                               id="{{$search}}"
                               value="{{request()->query(ResultsView::query)}}"
                               placeholder="Search">
                    </div>
                    <div class="absolute inset-y-0 right-14 2col:flex flex hidden py-1.5 pr-1.5">
                        <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs">Press
                            ( / )
                        </kbd>
                    </div>
                    <button class="relative -ml-px inline-flex shrink-0 items-center rounded-r-md px-3 2col:px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 gap-x-1.5 btn-ghost"
                            title="Search the site"
                            aria-label="Search">
                        <x-svg :name="'search'" class="!h-5 !w-5"/>
                    </button>
                </div>
            </form>
        </div>
        @auth()
            <form method="POST" class="hidden 2col:block my-auto mx-2 2col:mx-4 " action="{{ to()->auth->logout()}}">
                @csrf
                <x-a class="flex flex-no-wrap gap-1 hover:bg-base-200 p-2 text-sm font-bold rounded border"
                     :href="to()->auth->logout()"
                     title="Sign Out"
                     onclick="event.preventDefault(); this.closest('form').submit();">
                    <span>Sign</span> <span>Out</span>
                </x-a>
            </form>
        @endauth
        @guest()
            <x-a :href="to()->web->login->index()"
                 title="Go to Sign In Page"
                 class="my-auto mx-2 flex flex-no-wrap gap-1 hover:bg-base-200 p-2 text-sm font-bold rounded border">
                <span>Sign</span> <span>In</span></x-a>
        @endguest
    </div>
</header>
@vite('resources/js/masthead.js')