<?php

use App\Helpers\R;
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
        <div class="max-w-5xl min-[780px]:ml-[64px] min-[1312px]:ml-[258px]">
            @if($tag !== null)
                <a class="mb-2 flex gap-x-2 pt-2" title="{{$tag->name}}" href="{{R::results_tag($tag)}}">
                    @if($tag->hasLogo())
                        <x-img class="h-10 w-10 rounded" :file="$tag->logo()" :width="80"/>
                    @endif
                    <h2 class="-mx-1 my-auto text-lg font-semibold text-gray-900">
                        {{$tag->name}}
                    </h2>
                </a>
            @endif
            @if(request()->query(ResultsView::popular) !== null)
                <div class="mb-2 flex gap-x-2 pt-2" title="Popular">
                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <path fill="none" d="M0 0H24V24H0z"></path>
                            <path d="M5 3v16h16v2H3V3h2zm14.94 2.94l2.12 2.12L16 14.122l-3-3-3.94 3.94-2.12-2.122L13 6.88l3 3 3.94-3.94z"></path>
                        </g>
                    </svg>
                    <h2 class="-mx-1 my-auto text-lg font-semibold text-gray-900">
                        Popular
                    </h2>
                </div>
            @endif
            <div class="flex flex-col gap-3">
                @foreach($posts as $post)
                    <div class="flex gap-3">
                        <a class="relative" href="{{R::read($post)}}">
                            <div class="overflow-hidden 2col:rounded-lg bg-gray-200">
                                <x-img class="h-full w-full object-cover object-center"
                                       :file="$post->featuredImage()"
                                       :width="300"
                                       :title="''"/>
                            </div>
                            <x-reading-time-chip :post="$post"/>
                            <x-new-chip :post="$post"/>
                        </a>
                        <div class="flex flex-1 flex-col">
                            <a class="pb-4" href="{{R::read($post)}}">
                                <h3 class="font-bold break-word"
                                    title="{{ $post->title }}">{{ $post->title }}</h3>
                                <p class="text-sm text-gray-600"
                                   title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                                <p class="text-sm text-gray-600">
                                    {{$post->views}} {{$post->views === 1 ? 'view' : 'views'}}
                                    <span before="•"
                                          class="before:content-[attr(before)]"> {{$post->published_at->diffForHumans()}}</span>
                                </p>
                            </a>
                            <div class="flex">
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
                            <a class="pt-4 text-sm text-gray-600"
                               href="{{R::read($post)}}"
                               title="{{$post->subtitle}}">
                                {{$post->subtitle}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="flex h-full flex-col items-center justify-center">
            <div class="flex flex-col">
                @forEach($tags as $tag)
                    <a class="rounded-lg p-2 pl-6 hover:bg-gray-100" href="{{R::results($tag)}}">
                        {{$tag->name}}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</x-main>