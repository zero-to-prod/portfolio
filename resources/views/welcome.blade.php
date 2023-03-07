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
            <section class="mt-2">
                <a class="mb-4 2col:mb-0 block ml-2 2col:ml-0" href="{{R::results($tag)}}">
                    <div class="flex gap-x-2">
                        @if($tag->hasLogo())
                            <x-img class="h-10 w-10 rounded" :file="$tag->logo()" :width="80"/>
                        @endif
                        <h2 class="my-auto text-lg font-semibold text-gray-900">
                            {{$tag->name}}
                        </h2>
                    </div>
                </a>
                <div class="pb-4 pt-2 hidden 2col:block">
                    <x-divider/>
                </div>
                <div class="grid mb-4 grid-flow-row gap-4 2col:grid-cols-2 4col:grid-cols-4 2col:gap-2">
                    @foreach($tag->relatedPosts(limit: 4) as $post)
                        <a href="{{R::read($post)}}">
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
                            <div class="p-1 2col:px-0">
                                <h3 class="font-bold font-sm break-word"
                                    title="{{ $post->title }}">{{ $post->title }}</h3>
                                <div>
                                    <p class="text-sm text-gray-600"
                                       title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                                    <p class="text-sm text-gray-600">{{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
                                        <span before="•"
                                              class="before:content-[attr(before)]"> {{$post->published_at->diffForHumans()}}</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
    @endforeach
</x-main>
