<?php

use App\Models\Post;
use App\Http\Routes;

/* @var Post $post */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="mt-12 mx-auto max-w-7xl bg-gray-800 py-10 sm:rounded-lg">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-white">Posts</h1>
                    <p class="mt-2 text-sm text-gray-300">A list of all the posts.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button"
                            class="block rounded-md bg-indigo-500 py-1.5 px-3 text-center text-sm font-semibold leading-6 text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Add Post
                    </button>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">
                                    Published
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">
                                    Title
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Words
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Time
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach(Post::all() as $post)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                        {{$post->published_at?->format('d/m/Y')}}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                        <a class="underline" href="{{route_as(Routes::blog_post, $post)}}" target="_blank">{{$post->title}}</a>
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">
                                        {{$post->published_word_count   }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">
                                        {{$post->reading_time}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
