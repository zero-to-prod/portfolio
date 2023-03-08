@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

{{$post->original_publish_date?->diffForHumans()}}
