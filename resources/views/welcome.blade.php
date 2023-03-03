<?php

use App\Http\Routes;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
/* @var Tag $tag */

?>

<x-main>
    <div id="content">
        <div class="fixed top-0 w-full z-50 h-[56px] bg-white"
             id="masthead"
        >
            Masthead
        </div>
        <nav class="fixed top-0 bottom-0 mt-[56px] left-0 w-[240px] pl-4"
             id="drawer"
        >
            <h3 class="font-bold text-gray-800">Explore</h3>
            <ul>
                @forEach(\App\Models\Tag::all() as $tag)
                    <li class="p-2 hover:bg-gray-100 rounded-lg">{{$tag->name}}</li>
                @endforeach
            </ul>
        </nav>
        <div class="flex mt-[56px] ml-[240px]"
             id="page-manager">
            <div class="flex flex-col">
                @foreach(Tag::mostViewed() as $tag)
                    <div>
                        <h2>{{$tag->name}}</h2>
                        <div class="flex">
                            @foreach($tag->recommended() as $post)
                                <div>
                                    <h3>{{$post->title}}</h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-main>
