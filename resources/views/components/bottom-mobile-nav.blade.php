<?php

use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;

?>

<nav class="fixed bottom-0 left-0 2col:hidden w-full bg-primary-content">
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

