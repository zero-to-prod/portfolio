@props(['tags'])

<?php

use App\Http\Controllers\ResultsView;
use App\Models\Tag;
use Illuminate\Support\Collection;

/* @var Collection<Tag, Tag> $tags */
?>
<nav class="hidden w-wide-nav mt-narrow-nav nav-wide:block" id="left-nav-wide">
    <x-a class="{{ route_is(to()->welcome) ? 'bg-base-200' : '' }}"
         :href="to()->welcome()"
         title="Home"
    >
        <x-svg :name="'home'"/>
        Home
    </x-a>
    <x-a class="{{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="to()->resultsPopular()"
         title="Popular"
    >
        <x-svg :name="'popular'"/>
        Popular
    </x-a>
    <x-a class="{{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="to()->resultsTopics()"
         title="Topics"
    >
        <x-svg :name="'topics'"/>
        Topics
    </x-a>
    <x-a class="{{ route_is(to()->web->newsletter) ? 'bg-base-200' : '' }}"
         :href="to()->web->newsletter()"
         title="Subscribe to Newsletter"
    >
        <x-svg :name="'mail'"/>
        Newsletter
    </x-a>
    <x-divider class="py-2"/>
    @forEach($tags as $tag)
        <x-a class="{{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-base-200' : '' }}"
             :href="to()->results($tag)"
             title="Topic: {{$tag->name}}"
        >
            @if($tag->file !== null)
                <x-img class="w-6" :file="$tag->file" :width="80"/>
            @endif
            {{$tag->name}}
        </x-a>
    @endforeach
</nav>
<nav class="hidden text-xs mt-narrow-nav nav-small:block nav-wide:hidden"
     id="left-nav-narrow">
    <x-a class=" {{ route_is(to()->welcome) ? 'bg-base-200' : '' }}"
         :href="to()->welcome()"
         title="Home"
    >
        <x-svg :name="'home'" class="mx-auto"/>
        Home
    </x-a>
    <x-a class=" {{ request()->query(ResultsView::popular ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="to()->resultsPopular()"
         title="Popular"
    >
        <x-svg class="mx-auto" :name="'popular'"/>
        Popular
    </x-a>
    <x-a class=" {{ request()->query(ResultsView::topics ?? null) !== null ? 'bg-base-200' : '' }}"
         :href="to()->resultsTopics()"
         title="Topics"
    >
        <x-svg class="mx-auto" :name="'topics'"/>
        Topics
    </x-a>
    <x-a class=" {{ route_is(to()->web->newsletter) ? 'bg-base-200' : '' }}"
         :href="to()->web->newsletter()"
         title="Subscribe to Newsletter"
    >
        <x-svg class="mx-auto w-5" :name="'mail'"/>
        Newsletter
    </x-a>
    <x-divider class="py-2"/>
    @forEach($tags as $tag)
        <x-a class="!p-4 {{ request()->query(ResultsView::tag) === $tag->slug ? 'bg-base-200' : '' }}"
             :href="to()->results($tag)"
             title="{{$tag->name}}"
        >
            @if($tag->file !== null)
                <x-img class="mx-auto w-6" :file="$tag->file" :width="80" title="Topic: {{$tag->name}}"/>
            @endif
        </x-a>
    @endforeach
</nav>
@vite('resources/js/left_drawer.js')