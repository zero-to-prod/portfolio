<?php

use App\Helpers\R;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
/* @var Tag $tag */
?>

<x-main>
    <div class="flex w-full flex-col 4col:mx-auto 4col:max-w-7xl">
        @foreach($tags as $tag)
            <section>
                <x-a class="p-2 2col:mb-0 flex gap-x-2 2col:ml-0 btn-ghost" :href="R::results($tag)">
                    @if($tag->hasLogo())
                        <x-img class="w-10 my-auto rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold">
                        {{$tag->name}}
                    </h2>
                </x-a>
                <x-divider class="mb-4 mt-2"/>
                <div class="grid mb-4 grid-flow-row 2col:grid-cols-2 4col:grid-cols-4 2col:gap-2">
                    @foreach($tag->relatedPosts(limit: 4) as $post)
                        <x-a :href="R::read($post)">
                            <div class="relative">
                                <div class="overflow-hidden 2col:rounded-lg aspect-w-3 aspect-h-2">
                                    <x-img class="h-full w-full object-cover object-center"
                                           :file="$post->featuredImage()"
                                           :width="300"
                                           :title="''"
                                    />
                                </div>
                                <x-reading-time-chip :post="$post"/>
                                <x-new-chip :post="$post"/>
                            </div>
                            <div class="p-2 2col:px-0 2col:pt-1">
                                <h3 class="font-bold font-sm break-word tracking-tight leading-5"
                                    title="{{ $post->title }}">{{ $post->title }}</h3>
                                <p class="text-sm 2col:hidden" title="{{$post->subtitle}}">
                                    {{$post->subtitle}}
                                </p>
                                <p class="text-sm mt-2 2col:mt-0"
                                   title="{{$post->authorList()}}">
                                    {{$post->authorList()}}
                                </p>
                                <x-views-date-line :post="$post"/>
                            </div>
                        </x-a>
                    @endforeach
                </div>
            </section>
    @endforeach
</x-main>
