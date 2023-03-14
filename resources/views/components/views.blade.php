@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

<span {{ $attributes->merge(['class' => 'whitespace-nowrap']) }}>
    {{$post->views > 1000 ? floor($post->views / 1000) . 'k' : $post->views}} {{$post->views === 1 ? 'View' : 'Views'}}
</span>
