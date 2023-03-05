<?php

use App\Http\Controllers\FileServeController;
use App\Http\Routes;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
/* @var Tag $tag */
$tags = Tag::mostViewed()
?>

<x-main>
    <x-left-drawer :tags="$tags"/>
    <div class="ml-0 2col:px-4 min-[780px]:ml-[64px] min-[1312px]:ml-[238px]">
        <div class="flex w-full flex-col max-w-[2535px] min-[2535px]:mx-auto">
            @foreach($tags as $tag)
                <section class="mt-2">
                    <h2 class="mb-4 2col:block hidden text-lg font-bold">{{$tag->name}}</h2>
                    <div class="grid grid-flow-row 2col:grid-cols-2 3col:grid-cols-3 4col:grid-cols-4 5col:grid-cols-5 6col:grid-cols-6 2col:gap-4">
                        @foreach($tag->recommended()->take(4) as $post)
                            <a href="{{route_as(Routes::read, $post)}}">
                                <div class="relative">
                                    <div class="overflow-hidden 2col:rounded-lg aspect-w-3 aspect-h-2">
                                        <img class="h-full w-full object-cover object-center"
                                             src="{{ route_as(Routes::file, [FileServeController::file => $post->featuredImage()->name, FileServeController::width => 300])}}"
                                             alt="{{$post->featuredImage()->original_name}}"
                                             width="300"
                                             height="200"
                                        >
                                    </div>
                                    <div class="absolute right-0 bottom-0 m-2 rounded bg-gray-900 px-1 text-xs text-white shadow">
                                        {{$post->reading_time . ' min'}}
                                    </div>
                                    @if($post->original_publish_date->between(now(), now()->subDays(1)))
                                        <div class="absolute bottom-0 m-2 rounded bg-sky-600 px-1 text-xs text-white shadow">
                                            new
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3 2col:px-0">
                                    <h3 class="font-bold font-sm break-word"
                                        title="{{ $post->title }}">{{ $post->title }}</h3>
                                    <div>
                                        <p class="text-sm text-gray-600"
                                           title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                                        <p class="text-xs text-sm text-gray-600">{{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
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
        </div>
    </div>
</x-main>
