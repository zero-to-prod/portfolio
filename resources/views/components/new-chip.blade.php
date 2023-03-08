@props(['post', 'text' => null])

<?php

use App\Models\Post;

/* @var Post $post */
/* @var string $text */
?>

@if($post->original_publish_date->isToday())
    <div class="absolute bottom-0 m-2 rounded bg-sky-600 px-1 text-xs text-white shadow"
    title="{{$post->published_at->diffForHumans()}}"
    >
        new
    </div>
@endif