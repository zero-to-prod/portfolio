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
<nav class="fixed top-0 bottom-0 left-0 hidden w-[238px] mt-[60px] min-[1312px]:block hidden" id="left-nav-wide">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col">
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
               href="{{R::welcome()}}">
                <x-svg :name="'home'" />
                <span>Home</span>
            </a>
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_popular()}}">
                <x-svg :name="'popular'" />
                <span>Popular</span>
            </a>
            <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
               href="{{R::results_topics()}}">
                <x-svg :name="'topics'" />
                <span>Topics</span>
            </a>
            <div class="flex flex-col">
                @forEach($tags as $tag)
                    <a class="flex gap-6 p-4 pl-[20px] hover:bg-gray-300 {{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-gray-200' : '' }}"
                       href="{{R::results($tag)}}"
                    >
                        @if($tag->hasLogo())
                            <x-img class="w-6 rounded" :file="$tag->logo()" :width="80"/>
                        @endif
                        <span>{{$tag->name}}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</nav>
<nav class="fixed top-0 bottom-0 left-0 hidden mt-[60px] min-[780px]:block min-[1312px]:hidden" id="left-nav-narrow">
    <div class="flex flex-col">
        <a class="w-[64px] flex flex-col py-2 hover:bg-gray-300 {{ route_is(Routes::welcome) ? 'bg-gray-200' : '' }}"
           href="{{R::welcome()}}">
            <x-svg :name="'home'" class="mx-auto"/>
            <span class="text-xs mx-auto">Home</span>
        </a>
        <a class="w-[64px] flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-gray-200' : '' }}"
           href="{{R::results_popular()}}">
            <x-svg class="mx-auto" :name="'popular'" />
            <span class="text-xs mx-auto">Popular</span>
        </a>
        <a class="w-[64px] flex flex-col py-2 hover:bg-gray-300 {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-gray-200' : '' }}"
           href="{{R::results_topics()}}">
            <x-svg class="mx-auto" :name="'topics'" />
            <span class="text-xs mx-auto">Topics</span>
        </a>
        @forEach($tags as $tag)
            <a class="w-[64px] flex flex-col py-4 hover:bg-gray-300 {{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-gray-200' : '' }}"
               href="{{R::results($tag)}}"
            >
                @if($tag->hasLogo())
                    <x-img class="w-6 mx-auto" :file="$tag->logo()" :width="80"/>
                @endif
                </a>
            @endforeach
    </div>
</nav>