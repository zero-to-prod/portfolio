<?php

use App\Models\Post;

/* @var Post $post */
?>

<x-main :title="$post->title">
    <div data-blog="blog" class="mx-auto flex max-w-7xl flex-col gap-6 p-2 lg:p-6 lg:flex-row">
        <div aria-label="Content" class="lg:basis-2/3">
            <div aria-label="image">
                <img src="{{ Vite::asset('resources/images/slug.png') }}" alt="slug">
            </div>
            <article aria-label="Article" class="mt-2 flex flex-col gap-4">
                <div>
                    <h1>{{ $post->title }}</h1>
                    <div class="flex items-center gap-x-2 mt-2">
                        <img class="h-10 w-10 rounded-full" src="{{ Vite::asset('resources/images/david.jpg') }}"
                             alt="">
                        <div class="flex flex-col">
                            <a class="text-base font-semibold text-gray-900" href="#">David Smith</a>
                            <p class="text-sm font-semibold text-gray-600">Founder</p>
                        </div>
                    </div>
                </div>
                <div aria-label="Body">
                    {!! $body !!}
                </div>
            </article>
        </div>
        <div aria-label="Suggested Content" class="lg:basis-1/3">
            <div class="flex flex-col gap-4">
                @for($i = 0; $i < 10; $i++)
                    <a href="" class="flex flex-row">
                        <div class="relative">
                            <img class="rounded-lg" src="{{ Vite::asset('resources/images/slug.png') }}"
                                 alt=""
                                 width="168"
                            >
                            <div class="absolute bottom-0 text-white text-xs right-0 bg-gray-800 px-1 rounded m-2">6 min</div>
                        </div>
                        <div class="ml-2">
                            <h3>{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600">David Smith</p>
                            <p class="text-sm text-gray-600">13k Views • 2 months ago</p>
                        </div>

                    </a>
                @endfor
            </div>
        </div>
    </div>
</x-main>
