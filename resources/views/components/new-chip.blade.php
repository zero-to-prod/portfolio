@props(['post', 'text' => null])

<?php

use App\Models\Post;

/* @var Post $post */
/* @var string $text */
?>

@if($post->original_publish_date->gt(now()->subDays(3)))
    <div {{ $attributes->merge(['class' => 'z-10']) }} data-new-chip title="{{$post->original_publish_date->diffForHumans()}}">
        new
    </div>
@endif