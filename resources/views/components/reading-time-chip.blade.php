@props(['post', 'text' => null])

<?php

use App\Models\Post;

/* @var Post $post */
/* @var string $text */
?>

<div {{ $attributes->merge(['class' => 'absolute bottom-0 text-white shadow text-xs right-0 bg-gray-900 px-1 rounded m-2']) }}
     title="{{ $post->published_word_count  . ' words'}}"
>
    @if($text === null)
        {{$post->reading_time . ' min'}}
    @else
        {{$text}}
    @endif

</div>