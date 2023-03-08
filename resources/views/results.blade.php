<?php

use App\Helpers\R;
use App\Http\Controllers\ResultsView;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

/* @var Collection $posts */
/* @var Post $post */
/* @var Tag $tag */

?>
<x-main :title="request()->query(ResultsView::query)">
    <div class="flex flex-col gap-4 max-w-4xl mx-auto">
        <div>
            @if($tag !== null)
                <a class="flex gap-x-2 my-2 ml-2 2col:ml-0" title="{{$tag->name}}" href="{{R::results_tag($tag)}}">
                    @if($tag->hasLogo())
                        <x-img class="h-10 w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold text-gray-900">
                        {{$tag->name}}
                    </h2>
                </a>
                <x-divider/>
            @endif
            @if(request()->query(ResultsView::query) !== null)
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    <svg class="h-10 w-10 text-gray-600" viewBox="0 0 20 20" fill="currentColor"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                              clip-rule="evenodd"/>
                    </svg>
                    <h2 class="my-auto text-lg font-semibold text-gray-900">
                        Search Results
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if(request()->query(ResultsView::popular) !== null)
                <div class="mb-2 flex gap-x-2 pt-2 ml-2 2col:ml-0" title="Popular">
                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0H24V24H0z"></path>
                            <path d="M5 3v16h16v2H3V3h2zm14.94 2.94l2.12 2.12L16 14.122l-3-3-3.94 3.94-2.12-2.122L13 6.88l3 3 3.94-3.94z"></path>
                        </g>
                    </svg>
                    <h2 class="-mx-1 my-auto text-lg font-semibold text-gray-900">
                        Popular
                    </h2>
                </div>
                <x-divider/>
            @endif
        </div>
        @if($posts !== null && count($posts))
            <x-post-responsive :posts="$posts"/>
    </div>
    @else
        @if($posts !== null && count($posts) === 0)
            <div class="2col:ml-12 flex flex-col mx-auto gap-4 flex-wrap justify-center">
                <h2 class="text-lg">Nothing Found</h2>
            </div>
        @endif
        <div class="2col:ml-12 flex mx-auto gap-4 flex-wrap justify-center">
            @forEach(Tag::mostViewed() as $tag)
                <a class="rounded-lg p-2 hover:bg-gray-100 flex" href="{{R::results($tag)}}">
                    @if($tag->hasLogo())
                        <x-img class="h-10 w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <span class="ml-2 my-auto">{{$tag->name}}</span>
                </a>
            @endforeach
        </div>
    @endif
</x-main>