@props(['posts'])
<?php

use App\Helpers\PostTypes;
use App\Models\Post;
use Illuminate\Support\Collection;

/* @var Collection<Post, Post> $posts */
/* @var Post $post */
?>
<div {{$attributes->merge(['class' => '2col:space-y-2 space-y-4'])}}>
    @foreach($posts as $post)
        <div class="2col:flex 2col:flex-row shadow-lg 2col:shadow-none">
            <x-a class="relative" :href="to()->read($post)">
                <div class="relative shrink-0">
                    <div class="overflow-hidden 2col:rounded-lg ">
                        @if($post->post_type_id === PostTypes::animation)
                            <x-img class="2col:rounded-lg relative h-full w-full 2col:h-[200px] 2col:w-[300px] object-cover object-center z-10 opacity-0 2col:opacity-100 hover:opacity-0"
                                   :file="$post->animationFile"
                                   :width="300"
                                   :title="''"
                            />
                            <x-img class="2col:rounded-lg absolute top-0 h-full w-full 2col:h-[200px] 2col:w-[300px] object-cover object-center"
                                   :file="$post->altFile"
                                   :width="300"
                                   :title="''"
                            />
                        @else
                            <x-img class="h-full w-full 2col:h-[200px] 2col:w-[300px] object-cover object-center"
                                   :file="$post->file"
                                   :width="250"
                                   :title="''"
                            />
                        @endif
                    </div>
                    <x-new-chip :post="$post"/>
                    <x-reading-time-chip :post="$post"/>
                </div>
            </x-a>
            <div class="flex flex-1 flex-col 2col:my-0 p-2 2col:py-0">
                <x-a class="2col:pb-4" :href="to()->read($post)">
                    <h3 class="font-bold break-word tracking-tight leading-5" title="{{ $post->title }}">
                        {{ $post->title }}
                    </h3>
                    <p class="text-sm" title="{{$post->subtitle}}">
                        {{$post->subtitle}}
                    </p>
                    <p class="text-sm pt-2" title="{{$post->authorList()}}">
                        {{$post->authorList()}}
                    </p>
                    <x-views-date-line :post="$post"/>
                </x-a>
                <div class="hidden 2col:block">
                    <p class="text-sm font-bold">Topics</p>
                    <x-logos class="flex" :post="$post"/>
                </div>
            </div>
        </div>
    @endforeach
</div>

