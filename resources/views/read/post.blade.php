<?php

use App\Helpers\R;
use App\Models\Post;

/* @var Post $post */
/* @var File $feature */
?>

<x-main :title="$post->title">
    <div class="mx-auto block 3col:flex max-w-7xl 3col:flex-row gap-2">
        <div class="mx-auto shrink max-w-[837px]">
            <div class="relative">
                <x-img class="h-full w-full object-cover object-center"
                       :file="$post->featuredImage()"
                       :width="837"
                       :title="''"
                />
                <x-reading-time-chip :post="$post" :text="' min read'"/>
            </div>
            <article class="flex flex-col gap-6 2col:px-0 px-2" aria-label="Body">
                <div class="2col:block hidden">
                    <div class="flex justify-between pt-2">
                        <div>
                            <h1 class="text-2xl font-bold">{{$post->title}}</h1>
                            <p class="text-sm text-gray-500">{{$post->subtitle}}</p>
                        </div>
                        <div class="flex flex-col text-right text-sm text-gray-600">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center gap-x-2">
                        <x-img class="h-10 w-10 rounded-full" :file="$post->authorAvatar()" :height="80"/>
                        <div class="flex w-full flex-wrap justify-between">
                            <div class="flex flex-col justify-between">
                                <div class="flex gap-4">
                                    <div>
                                        <a class="text-base font-semibold text-gray-900"
                                           href="#">{{$post->authorList()}}</a>
                                        <p class="text-sm text-gray-600">{{$post->authors->first()->posts()->count()}}
                                            Posts</p>
                                    </div>
                                    <button type="button"
                                            class="my-auto flex gap-2 rounded-full bg-gray-600 py-2 text-sm font-semibold text-white shadow-sm px-3.5 hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                                            title="Be notified as new content becomes available">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                  d="M7.172,11.334 L10.0016129,13.2687863 L12.73,11.387 L18.844647,17.4201015 C18.6835279,17.47198 18.5117028,17.5 18.3333333,17.5 L1.66666667,17.5 C1.44656147,17.5 1.23642159,17.4573334 1.04406658,17.3798199 L7.172,11.334 Z M20,6.376 L20,15.8333333 C20,16.0799316 19.9464441,16.3140212 19.8503291,16.5246054 L13.856,10.611 L20,6.376 Z M0,6.429 L6.042,10.561 L0.105700422,16.4187119 C0.0373700357,16.2365871 1.90096522e-15,16.0393243 1.77635684e-15,15.8333333 L0,6.429 Z M18.3333333,2.5 C19.2538079,2.5 20,3.24619208 20,4.16666667 L20,4.753 L9.99838709,11.6476481 L0,4.81 L1.77635684e-15,4.16666667 C1.66363121e-15,3.24619208 0.746192084,2.5 1.66666667,2.5 L18.3333333,2.5 Z"></path>
                                        </svg>
                                        <span class="my-auto">Join Mailing List</span>
                                    </button>
                                </div>
                            </div>
                            <x-logos :post="$post"/>
                        </div>
                    </div>
                </div>
                <div class="flex 2col:hidden flex-col gap-4">
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-bold">{{$post->title}}</h1>
                        <p class="text-sm text-gray-500">{{$post->subtitle}}</p>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-center gap-x-2">
                            <x-img class="h-10 w-10 rounded-full" :file="$post->authorAvatar()" :height="80"/>
                            <div class="flex w-full flex-wrap justify-between">
                                <div class="flex flex-col justify-between">
                                    <a class="text-base font-semibold text-gray-900"
                                       href="#">{{$post->authorList()}}</a>
                                    <p class="text-sm text-gray-600">{{$post->authors->first()->posts()->count()}}
                                        Posts</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col text-right text-sm text-gray-600">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            <button type="button"
                                    class="my-auto flex gap-2 rounded-full bg-gray-600 py-2 text-sm font-semibold text-white shadow-sm px-3.5 hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                                        title="Keep up with new content">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill="currentColor" fill-rule="evenodd"
                                          d="M7.172,11.334 L10.0016129,13.2687863 L12.73,11.387 L18.844647,17.4201015 C18.6835279,17.47198 18.5117028,17.5 18.3333333,17.5 L1.66666667,17.5 C1.44656147,17.5 1.23642159,17.4573334 1.04406658,17.3798199 L7.172,11.334 Z M20,6.376 L20,15.8333333 C20,16.0799316 19.9464441,16.3140212 19.8503291,16.5246054 L13.856,10.611 L20,6.376 Z M0,6.429 L6.042,10.561 L0.105700422,16.4187119 C0.0373700357,16.2365871 1.90096522e-15,16.0393243 1.77635684e-15,15.8333333 L0,6.429 Z M18.3333333,2.5 C19.2538079,2.5 20,3.24619208 20,4.16666667 L20,4.753 L9.99838709,11.6476481 L0,4.81 L1.77635684e-15,4.16666667 C1.66363121e-15,3.24619208 0.746192084,2.5 1.66666667,2.5 L18.3333333,2.5 Z"></path>
                                </svg>
                                <span class="my-auto">
                                    Mailing List
                                        </span>
                            </button>
                        </div>
                        <x-logos :post="$post"/>
                    </div>

                </div>
                <div class="grid max-w-none prose">{!! $post->published_content !!}</div>
            </article>
        </div>
        <?php
        $posts = Post::related($post->tags, $post->id);
        ?>
        <div class="3col:flex hidden shrink-0 flex-col gap-2 w-[400px]">
            @foreach($posts as $post)
                <a href="{{R::read($post)}}" class="flex flex-row gap-2">
                    <div class="relative shrink-0">
                        <div class="overflow-hidden 2col:rounded-lg">
                            <x-img class="object-cover object-center h-[112px] w-[168px]"
                                   :file="$post->featuredImage()"
                                   :width="250"
                                   :title="''"
                            />
                        </div>
                        <x-reading-time-chip :post="$post"/>
                    </div>
                    <div>
                        <h3 class="mb-1 font-bold leading-5 tracking-tight break-word font-xs"
                            title="{{ $post->title }}">{{ $post->title }}</h3>
                        <div>
                            <p class="text-xs text-sm tracking-tight text-gray-600"
                               title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                            <x-views-date-line :post="$post"/>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6 flex 3col:hidden flex-col gap-2">
            <h3 class="my-auto text-lg font-semibold text-gray-900">
                Related
            </h3>
            <x-divider class="pt-2 pb-4"/>
            <x-post-responsive :posts="$posts"/>
        </div>
    </div>
</x-main>
