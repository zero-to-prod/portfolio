@props(['post'])

<?php

use App\Models\Tag;
use App\Models\Post;

/* @var Post $post */
/* @var Tag $tag */
?>

<div {{ $attributes->merge(['class' => 'flex']) }}>
    @foreach($post->tags()->limit(3)->get() as $tag)
        <x-a class="btn-ghost my-auto" :href="to()->web->results($tag)">
            <x-img class="w-10 p-2" :file="$tag->logo()" :width="80" :title="$tag->name"/>
        </x-a>
    @endforeach
</div>


