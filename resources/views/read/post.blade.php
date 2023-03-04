<?php

use App\Http\Routes;
use App\Models\Post;

/* @var Post $post */
/* @var File $feature */
?>

<x-main :title="$post->title">
    <div data-blog="blog" class="mx-auto flex max-w-7xl flex-col gap-6 p-2 lg:py-6 lg:px-0 lg:flex-row">
        <div aria-label="Content" class="lg:basis-2/3">
            <div aria-label="image" class="relative">
                <img src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'width' => 837])}}"
                     alt="{{$post->featuredImage()->original_name}}" width="837" height="537">
                <div class="absolute bottom-0 text-white right-0 bg-gray-800 px-1 m-2">
                    {{$post->reading_time . ' min read'}}
                </div>
            </div>
            <article aria-label="Article" class="flex flex-col gap-4">
                <div>
                    <h1 data-blog="title">{{ $post->title }}</h1>
                    <div class="flex items-center gap-x-2">
                        <img class="h-10 w-10 rounded-full"
                             src="{{ route_as(Routes::file, ['file' => $post->authorAvatar()->name, 'width' => 80])}}"
                             alt="">
                        <div class="flex justify-between w-full">
                            <div class="flex flex-col justify-between">
                                <a class="text-base font-semibold text-gray-900" href="#">{{$post->authorList()}}</a>
                                <p class="text-sm font-semibold text-gray-600">{{$post->authors->first()->title}}</p>
                            </div>
                            <div class="flex flex-col justify-between text-sm text-gray-600 text-right">
                                <p>{{$post->published_at?->format('F j, Y')}}</p>
                                <?php
                                $views = $post->views()->count();
                                ?>
                                <p>{{$views}} {{$views === 1 ? 'View' : 'Views'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div aria-label="Body">
                    {!! $post->published_content !!}
                </div>
            </article>
        </div>
        <div aria-label="Suggested Content" class="lg:basis-1/3">
            <div class="flex flex-col gap-2">
                @foreach(Post::recommended($post->tags, $post->id) as $post)
                    <a href="{{route_as(Routes::read, $post)}}" class="flex flex-row">
                        <div class="relative text-center  overflow-hidden rounded-lg">
                            <img class="h-[94px] width-[168px] object-cover"
                                 src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'width' => 168])}}"
                                 alt="{{$post->featuredImage()->original_name}}"
                                 width="168"
                                 height="94"
                            >
                            <div class="absolute bottom-0 text-white shadow text-xs right-0 bg-gray-900 px-1 rounded m-2">
                                {{$post->reading_time . ' min'}}
                            </div>
                        </div>
                        <div class="w-full ml-2 max-w-[200px] lg:max-w-[240px]">
                            <h3 class="mb-1 break-word font-bold font-sm tracking-tight"
                                title="{{ $post->title }}">{{ $post->title }}</h3>
                            <div>
                                <p class="text-sm text-gray-600 text-xs tracking-tight"
                                   title="{{$post->authorList()}}">{{$post->authorList()}}</p>

                                <p class="text-sm text-gray-600 text-xs tracking-tight">{{$post->views_count}} {{$post->views_count === 1 ? 'View' : 'Views'}}
                                    <span before=" • "
                                          class="before:content-[attr(before)]">{{$post->published_at->diffForHumans()}}</span>
                                </p>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-main>
