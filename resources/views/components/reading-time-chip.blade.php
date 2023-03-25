@props(['post', 'text' => null])

<?php

use App\Models\Post;

/* @var Post $post */
/* @var string $text */
?>

@if($post->public_reading_time > 0)
    <div data-reading-time-chip {{ $attributes->merge(['class' => 'z-50']) }}
    title="{{ $post->published_word_count  . ' words'}}"
    >
        @if($text === null)
            {{$post->public_reading_time . ' min'}}
        @else
            {{$post->public_reading_time . ' ' .$text}}
        @endif
    </div>
@endif