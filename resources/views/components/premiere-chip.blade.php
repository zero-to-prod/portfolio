@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

@if(auth()->user()->subsribed_at !== null)
    <x-a :href="to()->subscribe()" {{ $attributes->merge(['class' => 'absolute bottom-0 left-0 m-2 flex gap-2 rounded-md bg-gray-700 p-2 text-white']) }}>
        <x-svg :name="'premiere'" class="m-2 my-auto h-6 w-6 rounded-full animation-pulse"/>
        <div class="text-sm font-bold">
            <p>Premieres {{$post->premiere_at->tz('EST')->format('M d, Y')}}</p>
            <p>{{$post->premiere_at->tz('EST')->format('h:i A e')}}</p>
        </div>
    </x-a>
@endif