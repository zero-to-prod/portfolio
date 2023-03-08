@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>


{{$post->views}} {{$post->views === 1 ? 'View' : 'Views'}}
