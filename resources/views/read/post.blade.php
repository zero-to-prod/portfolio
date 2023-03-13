<?php

use App\Models\Post;
use Illuminate\Support\Collection;

/* @var Post $post */
/* @var File $feature */
/* @var Collection $tags */
?>

<x-main :title="$post->title">
    <div class="mx-auto justify-center block 3col:flex max-w-7xl 3col:flex-row gap-2">
        <div class="shrink max-w-[837px]">
            <div class="relative">
                <x-img class="h-full w-full object-cover object-center"
                       :file="$post->featuredImage()"
                       :width="837"
                       :title="''"
                />
                <x-reading-time-chip :post="$post" :text="' min read'"/>
            </div>
            <article class="space-y-6 2col:px-0 px-2" aria-label="Body">
                <div class="2col:block hidden space-y-2">
                    <div class="flex justify-between pt-2">
                        <div>
                            <h1 class="text-2xl font-bold">{{$post->title}}</h1>
                            <p class="text-sm">{{$post->subtitle}}</p>
                        </div>
                        <div class="text-right text-sm">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="flex w-full mt-2 flex-wrap justify-between">
                        <x-a class="flex gap-2 font-semibold mr-4" :href="'#'">
                            <x-img class="h-10 w-10 rounded-full my-auto" :file="$post->authorAvatar()" :height="80"/>
                            <div class="flex flex-col">
                                <p class="underline">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authors->first()->posts()->count()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <div class="flex gap-2">
                            <div class="flex gap-2">
                                <x-logos :post="$post"/>
                            </div>
                            <button id="share" type="button"
                                    class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300">
                                <x-svg :name="'share'" class="!h-6 !w-6"/>
                                <span class="text-sm font-bold my-auto">Share</span>
                            </button>
                            <script>
                                window.addEventListener('DOMContentLoaded', async function () {
                                    const shareButton = document.querySelector('#share');
                                    shareButton.addEventListener('click', async function () {
                                        const userAgentData = await navigator.userAgentData.getHighEntropyValues(['platform', 'platformVersion']);
                                        const shareData = {
                                            title: '{{$post->title}}',
                                            text: '{{$post->subtitle}}',
                                            url: '{{to()->web->read($post)}}',
                                        };
                                        if (userAgentData.platform === 'iOS' && parseFloat(userAgentData.platformVersion) < 14.7) {
                                            // Handle iOS versions that don't support the Web Share API
                                            // Redirect to a share page or display a share sheet overlay
                                        } else {
                                            await navigator.share(shareData);
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>

                </div>
                <div class="2col:hidden space-y-2">
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-bold">{{$post->title}}</h1>
                        <p class="text-sm">{{$post->subtitle}}</p>
                    </div>
                    <div class="flex justify-between">
                        <x-a class="flex gap-2 text-base font-semibold mr-4" :href="'#'">
                            <x-img class="h-10 w-10 rounded-full my-auto" :file="$post->authorAvatar()" :height="80"/>
                            <div>
                                <p class="underline">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authors->first()->posts()->count()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <div class="text-right text-sm">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <x-logos :post="$post"/>
                        </div>
                        <button id="share-mobile" type="button"
                                class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300 ml-auto">
                            <x-svg :name="'share'" class="!h-6 !w-6"/>
                            <span class="text-sm font-bold my-auto">Share</span>
                        </button>
                        <script>
                            window.addEventListener('DOMContentLoaded', function () {
                                const shareButton = document.querySelector('#share-mobile');
                                shareButton.addEventListener('click', async function () {
                                    await navigator.share({
                                        title: '{{$post->title}}',
                                        text: '{{$post->subtitle}}',
                                        url: '{{to()->web->read($post)}}',
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="grid max-w-none prose">
                    {!! $post->published_content !!}
                </div>
            </article>
        </div>
        <?php
        $posts = Post::related($post->tags, $post->id);
        ?>
        <div class="3col:flex hidden shrink-0 flex-col gap-2 w-[400px]">
            @foreach($posts as $post)
                <x-a :href="to()->web->read($post)" class="flex flex-row gap-2">
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
                    <div class="text-sm">
                        <h3 class="mb-1 font-bold leading-5 tracking-tight break-word"
                            title="{{ $post->title }}">{{ $post->title }}</h3>
                        <p class="tracking-tight"
                           title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                        <x-views-date-line :post="$post"/>
                    </div>
                </x-a>
            @endforeach
        </div>
        {{--        <div id="cta"--}}
        {{--             class="p-4 rounded-lg bg-gray-100 btn-ghost cursor-pointer flex justify-between shadow-lg">--}}
        {{--            <div class="flex gap-2">--}}
        {{--                <x-svg :name="'mail'"/>--}}
        {{--                <span class="my-auto font-bold">Stay up to date</span>--}}
        {{--            </div>--}}
        {{--            <p class="my-auto text-sm">Show more...</p>--}}
        {{--        </div>--}}

        <div class="mt-12 space-y-2 3col:hidden">
            <h3 class="my-auto text-lg font-semibold">Related</h3>
            <x-divider class="pt-2"/>
            <x-post-responsive :posts="$posts"/>
        </div>
    </div>
</x-main>
