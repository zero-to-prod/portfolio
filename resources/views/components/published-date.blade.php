@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

<meta itemprop="dateModified" content="{{$post->updated_at->toIso8601String()}}" />
<p {{ $attributes->merge(['class' => 'whitespace-nowrap']) }} itemprop="datePublished" content="{{$post->original_publish_date->toIso8601String()}}">
    {{$post->original_publish_date?->format('F j, Y')}}
</p>