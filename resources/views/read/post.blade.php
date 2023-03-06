<?php

use App\Helpers\R;
use App\Models\Post;

/* @var Post $post */
/* @var File $feature */
?>

<x-main :title="$post->title">
    <div data-blog="blog" class="mx-auto flex max-w-7xl flex-col gap-6 lg:px-0 lg:flex-row">
        <div aria-label="Content" class="lg:basis-2/3">
            <div aria-label="image" class="relative">
                <x-img :file="$post->featuredImage()" :width="837" :title="''"/>
                <x-reading-time-chip class="font-normal" :post="$post" :text="$post->reading_time . ' min read'"/>
                <x-new-chip :post="$post"/>
            </div>
            <article aria-label="Article" class="flex flex-col gap-4 px-2">
                <div>
                    <div class="flex flex-col 2col:flex-row justify-between pt-2">
                        <h1 class="font-bold text-xl 2col:py-2">{{ $post->title }}</h1>
                        <div class="flex mb-2">
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
                    </div>
                    <div class="flex items-center gap-x-2">
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
                <div aria-label="Body">
                    {!! $post->published_content !!}
                </div>
            </article>
        </div>
        <div aria-label="Suggested Content" class="lg:basis-1/3 px-2">
            <div class="flex flex-col gap-2">
                @foreach(Post::related($post->tags, $post->id) as $post)
                    <a href="{{R::read($post)}}" class="flex flex-row">
                        <div class="relative text-center  overflow-hidden rounded-lg">
                            <x-img class="h-[94px] width-[168px] object-cover"
                                   :file="$post->featuredImage()"
                                   :width="168"
                                   :title="''"/>
                            <x-reading-time-chip :post="$post"/>
                        </div>
                        <div class="w-full ml-2 max-w-[200px] lg:max-w-[240px]">
                            <h3 class="mb-1 break-word font-bold font-sm tracking-tight"
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
        </div>
    </div>
</x-main>
