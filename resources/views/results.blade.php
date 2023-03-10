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
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    @if($tag->hasLogo())
                        <x-img class="w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold text-gray-900">
                        {{$tag->name}}
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if(request()->query(ResultsView::query) !== null)
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    <x-svg :name="'search'" class="!h-10 !w-10"/>
                    <h2 class="my-auto text-lg font-semibold text-gray-900">
                        Search Results
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if(request()->query(ResultsView::popular) !== null)
                <div class="mb-2 flex gap-x-2 pt-2 ml-2 2col:ml-0" title="Popular">
                    <x-svg :name="'popular'" class="!h-10 !w-10"/>
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
                <x-a class="rounded-lg p-2 hover:bg-gray-100 flex" :href="R::results($tag)">
                    @if($tag->hasLogo())
                        <x-img class="w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <span class="ml-2 my-auto">{{$tag->name}}</span>
                </x-a>
            @endforeach
        </div>
    @endif
</x-main>