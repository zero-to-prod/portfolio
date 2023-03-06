@props(['tags'])

<?php

use App\Helpers\R;
use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;
use App\Models\Tag;
use Illuminate\Support\Collection;

/* @var Collection $tags */
/* @var Tag $tag */
?>
<nav class="fixed top-0 bottom-0 left-0 hidden w-[238px] mt-[64px] min-[1312px]:block">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col">
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
               href="{{R::welcome()}}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" aria-hidden="true">
                    <g>
                        <path d="M4,10V21h6V15h4v6h6V10L12,3Z"></path>
                    </g>
                </svg>
                <span>Home</span>
            </a>
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_popular()}}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <g>
                        <path fill="none" d="M0 0H24V24H0z"></path>
                        <path d="M5 3v16h16v2H3V3h2zm14.94 2.94l2.12 2.12L16 14.122l-3-3-3.94 3.94-2.12-2.122L13 6.88l3 3 3.94-3.94z"></path>
                    </g>
                </svg>
                <span>Popular</span>
            </a>
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_topics()}}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                     fill="currentColor">
                    <defs></defs>
                    <path d="M22.707,9.2931a.9992.9992,0,0,0-1.0234-.2417l-9,3a1.001,1.001,0,0,0-.6323.6323l-3,9a1,1,0,0,0,1.2651,1.2651l9-3a1.0013,1.0013,0,0,0,.6323-.6324l3-9A1,1,0,0,0,22.707,9.2931ZM11.5811,20.419l2.2094-6.6284L18.21,18.21Z"></path>
                    <path d="M16,30A14,14,0,1,1,30,16,14.0158,14.0158,0,0,1,16,30ZM16,4A12,12,0,1,0,28,16,12.0137,12.0137,0,0,0,16,4Z"></path>
                    <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1"
                          width="32"
                          height="32" style="fill: none"></rect>
                </svg>
                <span>Topics</span>
            </a>
        </div>
        <div class="relative">
            <div class="absolute -ml-4 inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="flex flex-col">
                @forEach($tags as $tag)
                    <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-gray-200' : '' }}"
                       href="{{R::results_tag($tag)}}"
                    >
                        <div class="flex gap-6">
                            @if($tag->hasLogo())
                                <x-img class="h-6 w-6 rounded" :file="$tag->logo()" :width="60"/>
                            @endif
                            <span>{{$tag->name}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>
<nav class="fixed top-0 bottom-0 left-0 hidden mt-[64px] min-[780px]:block min-[1312px]:hidden">
    <div class="flex flex-col">
        <a class="w-[64px] flex flex-col py-4 hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
           href="{{R::welcome()}}">
            <svg class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true">
                <g>
                    <path d="M4,10V21h6V15h4v6h6V10L12,3Z"></path>
                </g>
            </svg>
            <span class="text-xs mx-auto">Home</span>
        </a>
        <a class="w-[64px] flex flex-col py-4 hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
           href="{{R::results_popular()}}">
            <svg class="h-6 w-6 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <g>
                    <path fill="none" d="M0 0H24V24H0z"></path>
                    <path d="M5 3v16h16v2H3V3h2zm14.94 2.94l2.12 2.12L16 14.122l-3-3-3.94 3.94-2.12-2.122L13 6.88l3 3 3.94-3.94z"></path>
                </g>
            </svg>
            <span class="text-xs mx-auto">Popular</span>
        </a>
        <a class="w-[64px] flex flex-col py-4 hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
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