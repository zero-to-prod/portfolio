@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

<p {{ $attributes->merge(['class' => 'whitespace-nowrap']) }}>
    {{$post->original_publish_date?->format('F j, Y')}}
</p>