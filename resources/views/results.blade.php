<?php

use App\Http\Controllers\FileServeController;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Routes;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\ResultsController;

/* @var Collection $posts */
/* @var Post $post */
$tags = Tag::mostViewed()
?>
<x-main :title="request()->query(ResultsController::query)">
    <x-left-drawer :tags="$tags"/>
    @if($posts !== null && count($posts) )
        <div class="ml-0 flex bg-white min-[780px]:ml-[64px] min-[1312px]:ml-[258px] flex flex-col max-w-3xl gap-6">
            @foreach($posts as $post)
                <a class="flex" href="{{route_as(Routes::read, $post)}}">
                    <div class="relative">
                        <div class="overflow-hidden bg-gray-200 2col:rounded-lg">
                            <img class="h-full w-full object-cover object-center"
                                 src="{{ route_as(Routes::file, [FileServeController::file => $post->featuredImage()->name, FileServeController::width => 300])}}"
                                 alt="{{$post->featuredImage()->original_name}}"
                                 width="300"
                                 height="200"
                            >
                        </div>
                        <x-reading-time-chip :post="$post"/>
                        @if($post->original_publish_date->between(now(), now()->subDays(1)))
                            <div class="absolute bottom-0 m-2 rounded bg-sky-600 px-1 text-xs text-white shadow right-left">
                                new
                            </div>
                        @endif
                    </div>
                    <div class="bg-white px-3 flex-1">
                        <h3 class="font-bold tracking-tight font-sm break-word"
                            title="{{ $post->title }}">{{ $post->title }}</h3>
                        <div class="flex flex-col gap-6">
                            <p class="text-xs text-sm tracking-tight text-gray-600">{{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
                                <span before="•"
                                      class="before:content-[attr(before)]"> {{$post->published_at->diffForHumans()}}</span>
                            </p>
                            <div class="flex items-center gap-x-2">
                                <img class="h-10 w-10 rounded-full"
                                     src="{{ route_as(Routes::file, [FileServeController::file => $post->authorAvatar()->name, FileServeController::width => 80])}}"
                                     alt="">
                                <p class="text-xs tracking-tight text-gray-600"
                                   title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                            </div>
                            <p title="{{$post->subtitle}}" class="text-sm tracking-tight text-gray-600">
                                {{$post->subtitle}}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center h-full">
            <div class="flex flex-col">
                @forEach($tags as $tag)
                    <a class="rounded-lg pl-6 p-2 hover:bg-gray-100"
                       href="{{route_as(Routes::results, [ResultsController::tag => $tag->slug])}}"
                    >{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    @endif
</x-main>