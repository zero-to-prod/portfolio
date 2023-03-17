<?php

use App\Http\Controllers\ResultsView;

?>

<nav id="bottom-nav"
     class="fixed transition-all duration-500 bottom-0 left-0 2col:hidden w-full bg-primary-content drop-shadow-[0_-3px_4px_rgba(0,0,0,0.25)]">
    <div class="grid grid-cols-3">
        <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
           href="{{to()->web->resultsPopular()}}">
            <x-svg :name="'popular'" class="mx-auto"/>
            <span class="mx-auto text-xs">Popular</span>
        </a>
        <a class="flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
           href="{{to()->web->resultsTopics()}}">
            <x-svg :name="'topics'" class="mx-auto"/>
            <span class="mx-auto text-xs">Topics</span>
        </a>
        <a class="flex flex-col py-2 hover:bg-gray-300 {{ route_is(to()->web->newsletter) ? 'bg-gray-200' : '' }}"
           href="{{to()->web->subscribe()}}">
            <x-svg :name="'mail'" class="mx-auto"/>
            <span class="mx-auto text-xs">Subscribe</span>
        </a>
    </div>
</nav>

