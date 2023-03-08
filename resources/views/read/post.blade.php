<?php

use App\Helpers\R;
use App\Models\Post;

/* @var Post $post */
/* @var File $feature */
?>

<x-main :title="$post->title">
    <div class="block 3col:flex 3col:flex-row gap-2 max-w-7xl mx-auto">
        <div class="max-w-[837px] shrink mx-auto">
            <div class="relative">
                <div class="overflow-hidden 2col:rounded-lg">
                    <x-img class="h-full w-full object-cover object-center"
                           :file="$post->featuredImage()"
                           :width="837"
                           :title="''"
                    />
                </div>
                <x-reading-time-chip :post="$post"/>
            </div>
            <article class="flex flex-col gap-6 px-2 2col:px-0" aria-label="Body">
                <div>
                    <div class="flex flex-col 2col:flex-row justify-between pt-2">
                        <div>
                            <h1 class="font-bold text-2xl">{{ $post->title }}</h1>
                            <p class="text-sm text-gray-500">{{$post->subtitle}}</p>
                        </div>
                        <div class="flex mb-2">
                            @foreach($post->tags()->get() as $tag)
                                @if($tag->hasLogo())
                                    <a class="h-10 w-10 ring-inset ring-gray-100 hover:shadow hover:ring-1"
                                       href="{{R::results($tag)}}">
                                        <x-img class="p-2" :file="$tag->logo()" :width="60"
                                               :title="$tag->name"/>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center gap-x-2 mt-2">
                        <x-img class="h-10 w-10 rounded-full" :file="$post->authorAvatar()" :height="80"/>
                        <div class="flex justify-between w-full">
                            <div class="flex flex-col justify-between">
                                <a class="text-base font-semibold text-gray-900" href="#">{{$post->authorList()}}</a>
                                <p class="text-sm font-semibold text-gray-600">{{$post->authors->first()->title}}</p>
                            </div>
                            <div class="flex flex-col justify-between text-sm text-gray-600 text-right">
                                <p>{{$post->published_at?->format('F j, Y')}}</p>
                                <p>{{$post->views}} {{$post->views === 1 ? 'View' : 'Views'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prose max-w-none">{!! $post->published_content !!}</div>
            </article>
        </div>
        <?php
            $posts = Post::related($post->tags, $post->id );
        ?>
        <div class="hidden 3col:flex w-[400px] shrink-0 flex-col gap-2">
            @foreach($posts as $post)
                <a href="{{R::read($post)}}" class="flex flex-row gap-2">
                    <div class="relative shrink-0">
                        <div class="overflow-hidden 2col:rounded-lg ">
                            <x-img class="h-[94px] w-[168px] object-cover object-center"
                                   :file="$post->featuredImage()"
                                   :width="250"
                                   :title="''"
                            />
                        </div>
                        <x-reading-time-chip :post="$post"/>
                    </div>
                    <div>
                        <h3 class="mb-1 break-word font-bold font-xs tracking-tight leading-5"
                            title="{{ $post->title }}">{{ $post->title }}</h3>
                        <div>
                            <p class="text-sm text-gray-600 text-xs tracking-tight"
                               title="{{$post->authorList()}}">{{$post->authorList()}}</p>

                            <p class="text-sm text-gray-600 text-xs tracking-tight">{{$post->views}} {{$post->views === 1 ? 'View' : 'Views'}}
                                <span before=" • "
                                      class="before:content-[attr(before)]">{{$post->published_at->diffForHumans()}}</span>
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <x-post-responsive class="block 3col:hidden" :posts="$posts"/>
    </div>
</x-main>
