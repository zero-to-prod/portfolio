<?php

use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

/* @var Collection $posts */
/* @var Post $post */
/* @var Tag $tag */

?>
<x-main :title="request()->query(ResultsView::query)">
    <x-left-drawer :tags="$tags"/>
    @if($posts !== null && count($posts) )
        <div class="ml-0 flex bg-white min-[780px]:ml-[64px] min-[1312px]:ml-[258px] flex flex-col max-w-3xl gap-6 px-4">
            @if($tag !== null)
                <div class="flex gap-x-2">
                    @if($tag->hasLogo())
                        <x-img class="h-10 w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold text-gray-900 text-base">
                        {{$tag->name}}
                    </h2>
                </div>
            @endif
            @foreach($posts as $post)
                <div class="flex">
                    <a class="relative" href="{{route_as(Routes::read, $post)}}">
                        <div class="overflow-hidden bg-gray-200 2col:rounded-lg">
                            <x-img class="h-full w-full object-cover object-center"
                                   :file="$post->featuredImage()"
                                   :width="300"
                                   :title="''"/>
                        </div>
                        <x-reading-time-chip :post="$post"/>
                        <x-new-chip :post="$post"/>
                    </a>
                    <div class="bg-white px-3 flex-1">
                        <a href="{{route_as(Routes::read, $post)}}">
                            <h3 class="font-bold tracking-tight font-sm break-word"
                                title="{{ $post->title }}">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600 text-xs tracking-tight"
                               title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                        </a>
                        <div class="flex flex-col gap-4">
                            <a class="text-xs text-sm tracking-tight text-gray-600"
                               href="{{route_as(Routes::read, $post)}}">
                                {{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
                                <span before="•"
                                      class="before:content-[attr(before)]"> {{$post->published_at->diffForHumans()}}</span>
                            </a>
                            <div class="flex items-center gap-x-2">
                                @foreach($post->tags()->get() as $tag)
                                    @if($tag->hasLogo())
                                        <a href="{{route_as(Routes::results, [ResultsView::tag => $tag->slug])}}">
                                            <x-img class="h-6 w-6 rounded" :file="$tag->logo()" :width="60"
                                                   :title="$tag->name"/>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <a class="text-sm tracking-tight text-gray-600"
                               href="{{route_as(Routes::read, $post)}}"
                               title="{{$post->subtitle}}">
                                {{$post->subtitle}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center h-full">
            <div class="flex flex-col">
                @forEach($tags as $tag)
                    <a class="rounded-lg pl-6 p-2 hover:bg-gray-100"
                       href="{{route_as(Routes::results, [ResultsView::tag => $tag->slug])}}"
                    >{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    @endif
</x-main>