@props(['post', 'text' => null])

<?php

use App\Models\Post;

/* @var Post $post */
/* @var string $text */
?>

<div data-reading-time-chip {{ $attributes->merge(['class' => '']) }}
     title="{{ $post->published_word_count  . ' words'}}"
>
    @if($text === null)
        {{$post->reading_time . ' min'}}
    @else
        {{$post->reading_time . ' ' .$text}}
    @endif
</div>