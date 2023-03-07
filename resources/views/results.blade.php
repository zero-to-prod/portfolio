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
                <div class="hidden 2col:block">
                    <x-divider/>
                </div>
            @endif
            @if(request()->query(ResultsView::popular) !== null)
                <div class="mb-2 flex gap-x-2 pt-2" title="Popular">
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
                <div class="hidden 2col:block">
                    <x-divider/>
                </div>
            @endif
        </div>
        @if($posts !== null && count($posts) )
            @foreach($posts as $post)
                <div class="flex flex-col 3col:flex-row gap-2">
                    <a class="relative" href="{{R::read($post)}}">
                        <div class="overflow-hidden 2col:rounded-lg bg-gray-200">
                            <x-img class="h-full w-full object-cover object-center"
                                   :file="$post->featuredImage()"
                                   :width="300"
                                   :title="''"/>
                        </div>
                        <x-reading-time-chip :post="$post"/>
                        <x-new-chip :post="$post"/>
                    </a>
                    <div class="flex flex-1 flex-col px-2 3col:my-0">
                        <a class="pb-4" href="{{R::read($post)}}">
                            <h3 class="font-bold break-word"
                                title="{{ $post->title }}">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600"
                               title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                            <p class="text-sm text-gray-600">
                                {{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
                                <span before="•"
                                      class="before:content-[attr(before)]"> {{$post->published_at->diffForHumans()}}</span>
                            </p>
                        </a>
                        <div class="flex">
                            @foreach($post->tags()->get() as $tag)
                                @if($tag->hasLogo())
                                    <a class="p-2 ring-inset ring-gray-100 hover:shadow hover:ring-1"
                                       href="{{R::results($tag)}}">
                                        <x-img class="h-6 w-6" :file="$tag->logo()" :width="60"
                                               :title="$tag->name"/>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <a class="pt-4 text-sm text-gray-600"
                           href="{{R::read($post)}}"
                           title="{{$post->subtitle}}">
                            {{$post->subtitle}}
                        </a>
                    </div>
                </div>
            @endforeach
    </div>
    @else
        <div class="2col:absolute 2col:ml-12 flex mx-auto gap-4 flex-wrap justify-center">
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