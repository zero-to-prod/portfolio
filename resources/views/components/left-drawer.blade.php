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
<nav class="hidden w-[238px] mt-[60px] min-[1312px]:block" id="left-nav-wide">
    <x-a class="{{ route_is(Routes::welcome) ? 'bg-base-200' : '' }}"
         :href="R::welcome()"
         title="Home"
    >
        <x-svg :name="'home'"/>
        Home
    </x-a>
    <x-a class="{{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="R::results_popular()"
         title="Popular"
    >
        <x-svg :name="'popular'"/>
        Popular
    </x-a>
    <x-a class="{{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="R::results_topics()"
         title="Topics"
    >
        <x-svg :name="'topics'"/>
        Topics
    </x-a>
    @forEach($tags as $tag)
        <x-a class="{{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-base-200' : '' }}"
             :href="R::results($tag)"
             title="{{$tag->name}}"
        >
            @if($tag->hasLogo())
                <x-img class="w-6" :file="$tag->logo()" :width="80"/>
            @endif
            {{$tag->name}}
        </x-a>
    @endforeach
</nav>
<nav class="hidden text-xs mt-[60px] min-[780px]:block min-[1312px]:hidden"
     id="left-nav-narrow">
    <x-a class=" {{ route_is(Routes::welcome) ? 'bg-base-200' : '' }}"
         :href="R::welcome()"
         title="Home"
    >
        <x-svg :name="'home'" class="mx-auto"/>
        Home
    </x-a>
    <x-a class=" {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="R::results_popular()"
         title="Popular"
    >
        <x-svg class="mx-auto" :name="'popular'"/>
        Popular
    </x-a>
    <x-a class=" {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="R::results_topics()"
         title="Topics"
    >
        <x-svg class="mx-auto" :name="'topics'"/>
        Topics
    </x-a>
    @forEach($tags as $tag)
        <x-a class="!p-4 {{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-base-200' : '' }}"
             :href="R::results($tag)"
             title="{{$tag->name}}"
        >
            @if($tag->hasLogo())
                <x-img class="mx-auto w-6" :file="$tag->logo()" :width="80" title="{{$tag->name}}"/>
            @endif
        </x-a>
    @endforeach
</nav>
@vite('resources/js/left_drawer.js')