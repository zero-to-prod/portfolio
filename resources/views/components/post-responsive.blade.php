@php use App\Models\Post;use Illuminate\Support\Collection; @endphp
@props(['posts'])
<?php
/* @var Collection<Post> $posts */
/* @var Post $post */
?>
<div {{$attributes->merge(['class' => 'flex flex-col gap-2'])}}>
    @foreach($posts as $post)
        <div class="flex flex-col 3col:flex-row gap-2">
            <a class="relative" href="{{R::read($post)}}">
                <div class="relative shrink-0">
                    <div class="overflow-hidden 2col:rounded-lg ">
                        <x-img class="h-full w-full 3col:h-[200px] 3col:w-[300px] object-cover object-center"
                               :file="$post->featuredImage()"
                               :width="300"
                               :title="''"
                        />
                    </div>
                    <x-new-chip :post="$post"/>
                    <x-reading-time-chip :post="$post"/>
                </div>
            </a>
            <div class="flex flex-1 flex-col px-2 3col:my-0">
                <a class="2col:pb-4" href="{{R::read($post)}}">
                    <h3 class="font-bold break-word tracking-tight leading-5"
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
                <a class="2col:pt-4 text-sm text-gray-600"
                   href="{{R::read($post)}}"
                   title="{{$post->subtitle}}">
                    {{$post->subtitle}}
                </a>
            </div>
        </div>
    @endforeach
</div>

