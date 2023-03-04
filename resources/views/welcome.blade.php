<?php

use App\Http\Routes;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
/* @var Tag $tag */
$tags = Tag::mostViewed()
?>

<x-main>
    <div id="content">
        <div class="fixed top-0 z-50 w-full bg-white h-[56px]"
             id="masthead"
        >
            Masthead
        </div>
        <nav class="fixed top-0 bottom-0 left-0 hidden pl-4 mt-[56px] min-[780px]:block min-[780px]:w-[64px] min-[1312px]:w-[240px]"
             id="drawer"
        >
            <h3 class="font-bold text-gray-800">Explore</h3>
            <ul>
                @forEach($tags as $tag)
                    <li class="rounded-lg p-2 hover:bg-gray-100">{{$tag->name}}</li>
                @endforeach
            </ul>
        </nav>
        <div class="ml-0 flex mt-[56px] min-[780px]:ml-[64px] min-[1312px]:ml-[240px]"
             id="page-manager">
            <div class="mx-2 flex w-full flex-col gap-8 max-w-[2535px] sm:mx-0 min-[2535px]:mx-auto">
                @foreach($tags as $tag)
                    <section aria-labelledby="products-heading"
                             class="overflow-hidden sm:px-6 lg:px-8">
                        <h2 class="mb-4 text-lg font-bold">{{$tag->name}}</h2>
                        <div class="grid grid-flow-row grid-cols-1 gap-4 min-[490px]:grid-cols-2 min-[870px]:grid-cols-3 min-[1142px]:grid-cols-4 min-[1978px]:grid-cols-5 min-[2302px]:grid-cols-6">
                            @foreach($tag->recommended()->take(4) as $post)
                                <a href="{{route_as(Routes::read, $post)}}" class="flex flex-col">
                                    <div class="relative">
                                        <div class="overflow-hidden rounded-lg bg-gray-200 aspect-w-3 aspect-h-2 group-hover:opacity-75">
                                            <img class="h-full w-full object-cover object-center"
                                                 src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'width' => 300])}}"
                                                 alt="{{$post->featuredImage()->original_name}}"
                                                 width="300"
                                                 height="200"
                                            >
                                        </div>
                                        <div class="absolute right-0 bottom-0 m-2 rounded bg-gray-800 px-1 text-xs text-white">
                                            {{$post->reading_time . ' min'}}
                                        </div>
                                        @if($post->originally_published_at->between(now(), now()->subDays(1)))
                                            <div class="absolute right-left bottom-0 m-2 rounded-full bg-sky-600 px-1 text-xs text-white">
                                                new
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="mt-2 font-bold tracking-tight break-word font-sm"
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
    </div>
</x-main>
