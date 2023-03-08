@props(['post'])

<?php

use App\Models\Tag;
use App\Models\Post;

/* @var Post $post */
/* @var Tag $tag */
?>

<div {{ $attributes->merge(['class' => 'flex']) }}>
    @foreach($post->tags()->limit(3)->get() as $tag)
        <a class="hover:bg-gray-200 my-auto" href="{{R::results($tag)}}">
            <x-img class="w-10 p-2" :file="$tag->logo()" :width="80" :title="$tag->name . ': related posts'"/>
        </a>
    @endforeach
</div>


