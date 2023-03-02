<?php

use App\Http\Routes;
use App\Models\Post;

/* @var Post $post */
/* @var File $feature */
$feature = $post->featuredImage();
?>

<x-main :title="$post->title">
    <div data-blog="blog" class="mx-auto flex max-w-7xl flex-col gap-6 p-2 lg:py-6 lg:px-0 lg:flex-row">
        <div aria-label="Content" class="lg:basis-2/3">
            <div aria-label="image" class="relative">
                <img src="{{ route_as(Routes::file, ['file' => $feature->name, 'width' => 837])}}"
                     alt="{{$feature->original_name}}" width="837" height="537">
                <div class="absolute bottom-0 text-white right-0 bg-gray-800 px-1 m-2">
                    {{$post->reading_time . ' min read'}}
                </div>
            </div>
            <article aria-label="Article" class="mt-2 flex flex-col gap-4">
                <div>
                    <h1 data-blog="title">{{ $post->title }}</h1>
                    <div class="flex items-center gap-x-2 mt-2">
                        <img class="h-10 w-10 rounded-full"
                             src="{{ route_as(Routes::file, ['file' => $post->authorAvatar()->name, 'width' => 50])}}"
                             alt="">
                        <div class="flex justify-between w-full">
                            <div>
                                <a class="text-base font-semibold text-gray-900" href="#">{{$post->authorList()}}</a>
                                <p class="text-sm font-semibold text-gray-600">{{$post->authors->first()->title}}</p>
                            </div>
                            <div class="text-sm text-gray-600 text-right">
                                <p>{{$post->published_at?->format('F j, Y')}}</p>
                                <p>{{$post->views()->count()}} {{$post->views()->count() === 1 ? 'View' : 'Views'}}</p>
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
                @foreach(Post::recommended($post->tags) as $post)
                    <a href="{{route_as(Routes::blog_post, $post)}}" class="flex flex-row">
                        <div class="relative">
                            <img class="rounded-lg"
                                 src="{{ route_as(Routes::file, ['file' => $feature->name, 'width' => 168])}}"
                                 alt="{{$feature->original_name}}"
                                 width="168"
                                 height="112"
                            >
                            <div class="absolute bottom-0 text-white text-xs right-0 bg-gray-800 px-1 rounded m-2">
                                {{$post->reading_time . ' min'}}
                            </div>
                        </div>
                        <div class="ml-2">
                            <h3 class="mb-1">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600">{{$post->authorList()}}</p>
                                <?php
                                $views = $post->views()->count();
                                ?>
                            <p class="text-sm text-gray-600">{{$views}} {{$views === 1 ? 'View' : 'Views'}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-main>
