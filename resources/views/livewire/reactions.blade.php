<?php
/* @var \App\Models\Post $post */
$liked = $post->liked();
$disliked = $post->disliked();
?>

<div class="my-auto">
<span class="isolate inline-flex rounded-md ">
  <button type="button" wire:click="like"
          class="relative bg-gray-200 space-x-2 inline-flex items-center rounded-l-lg  px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-300 focus:z-10">
    @if($liked)
          <x-svg :name="'thumb-up-filled'"/>
      @else
          <x-svg :name="'thumb-up'"/>
      @endif
    <span>{{$post->likes}}</span>
  </button>
  <button type="button" wire:click="dislike"
          class="bg-gray-200 relative -ml-px inline-flex items-center rounded-r-lg  px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-300 focus:z-10">
        @if($disliked)
          <x-svg :name="'thumb-down-filled'"/>
      @else
          <x-svg :name="'thumb-down'"/>
      @endif
  </button>
</span>
</div>
