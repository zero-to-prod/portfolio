<?php
/* @var \App\Models\Post $post */
$liked = $post->liked();
$disliked = $post->disliked();
?>

<div id="like-buttons" class="my-auto isolate inline-flex rounded-md overflow-hidden">
    <button type="button" wire:click="like" title="Like">
        @if($liked)
            <x-svg :name="'thumb-up-filled'"/>
        @else
            <x-svg :name="'thumb-up'"/>
        @endif
        <span>{{$post->likes}}</span>
    </button>
    <button type="button" wire:click="dislike" title="Dislike">
        @if($disliked)
            <x-svg :name="'thumb-down-filled'"/>
        @else
            <x-svg :name="'thumb-down'"/>
        @endif
    </button>
</div>
