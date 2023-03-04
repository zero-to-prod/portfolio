<?php

use App\Http\Routes;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
/* @var Tag $tag */
$tags = Tag::mostViewed()
?>

<x-main>
    <nav class="fixed top-0 bottom-0 left-0 hidden pl-4 mt-[56px] min-[780px]:w-[64px] min-[1312px]:w-[240px] min-[780px]:block"
         id="drawer"
    >
        <h3 class="font-bold text-gray-800">Explore</h3>
        <ul>
            @forEach($tags as $tag)
                <li class="rounded-lg p-2 hover:bg-gray-100">{{$tag->name}}</li>
            @endforeach
        </ul>
    </nav>
    <nav class="fixed top-0 left-0 hidden min-[490px]:block mt-[56px] bg-white z-50  w-full shadow-lg min-[490px]:shadow min-[780px]:shadow-none"
         id="drawer"
    >
        <ul class="ml-0 grid grid-flow-col auto-cols-max overflow-y-auto py-4 bg-white space-x-4 min-[780px]:ml-[64px] min-[1312px]:ml-[240px] min-[490px]:px-4">
            @forEach($tags as $tag)
                <li class="rounded-lg bg-gray-100 p-2 hover:bg-gray-200">{{$tag->name}}</li>
            @endforeach
        </ul>
    </nav>
    <div class="ml-0 flex bg-white min-[780px]:ml-[64px] min-[1312px]:ml-[240px]"
         id="page-manager">
        <div class="flex w-full flex-col max-w-[2535px] min-[2535px]:mx-auto min-[490px]:mt-6 min-[490px]:gap-6">
            @foreach($tags as $tag)
                <section class="overflow-hidden min-[490px]:px-4">
                    <h2 class="mb-4 hidden text-lg font-bold min-[490px]:block">{{$tag->name}}</h2>
                    <div class="grid grid-flow-row grid-cols-1 min-[490px]:grid-cols-2 min-[870px]:grid-cols-3 min-[1142px]:grid-cols-4 min-[1978px]:grid-cols-5 min-[2302px]:grid-cols-6 min-[490px]:gap-4">
                        @foreach($tag->recommended()->take(4) as $post)
                            <a href="{{route_as(Routes::read, $post)}}" class="flex flex-col">
                                <div class="relative">
                                    <div class="overflow-hidden bg-gray-200 aspect-w-3 aspect-h-2 group-hover:opacity-75 min-[490px]:rounded-lg">
                                        <img class="h-full w-full object-cover object-center"
                                             src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'width' => 300])}}"
                                             alt="{{$post->featuredImage()->original_name}}"
                                             width="300"
                                             height="200"
                                        >
                                    </div>
                                    <div class="absolute right-0 bottom-0 m-2 rounded bg-gray-900 px-1 text-xs text-white shadow">
                                        {{$post->reading_time . ' min'}}
                                    </div>
                                    @if($post->originally_published_at->between(now(), now()->subDays(1)))
                                        <div class="absolute bottom-0 m-2 rounded bg-sky-600 px-1 text-xs text-white shadow right-left">
                                            new
                                        </div>
                                    @endif
                                </div>
                                <div class="bg-white p-3 min-[490px]:px-0">
                                    <h3 class="font-light tracking-tight font-sm break-word min-[490px]:font-normal min-[490px]:font-bold"
                                        title="{{ $post->title }}">{{ $post->title }}</h3>
                                    <div>
                                        <p class="text-xs text-sm tracking-tight text-gray-600"
                                           title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                                            <?php
                                            $views = $post->views()->count();
                                            ?>
                                        <p class="text-xs text-sm tracking-tight text-gray-600">{{$views}} {{$views === 1 ? 'view' : 'views'}}
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
