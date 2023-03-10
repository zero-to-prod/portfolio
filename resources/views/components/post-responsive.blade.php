@php use App\Models\Post;use Illuminate\Support\Collection; @endphp
@props(['posts'])
<?php
/* @var Collection<Post> $posts */
/* @var Post $post */
?>
<div {{$attributes->merge(['class' => 'flex flex-col gap-2'])}}>
    @foreach($posts as $post)
        <div class="flex flex-col 3col:flex-row gap-2">
            <x-a class="relative" :href="R::read($post)">
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
            </x-a>
            <div class="flex flex-1 flex-col px-2 3col:my-0">
                <x-a class="2col:pb-4" :href="R::read($post)">
                    <h3 class="font-bold break-word tracking-tight leading-5"
                        title="{{ $post->title }}">{{ $post->title }}</h3>
                    <p class="2col:pt-4 text-sm"title="{{$post->subtitle}}">
                        {{$post->subtitle}}
                    </p>
                    <p class="text-sm pt-2"
                       title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                    <x-views-date-line :post="$post"/>
                </x-a>
                <x-logos class="hidden 2col:flex" :post="$post"/>
            </div>
        </div>
    @endforeach
</div>

