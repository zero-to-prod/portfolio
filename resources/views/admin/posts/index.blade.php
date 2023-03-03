<?php

use App\Http\Routes;
use App\Models\Post;

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
            <div class="sm:flex sm:items-center flex-row-reverse">
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{route_as(Routes::admin_posts_create)}}" class="btn">
                        Add Post
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Posts
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Views
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach(Post::with(['views', 'authors'])->orderBy(Post::published_at)->get() as $post)
                                <tr>
                                    <th class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                        <div class="flex justify-between">
                                            <div class="flex  gap-4">
                                                <figure>
                                                    <a class="underline" href="{{route_as(Routes::blog_post, $post)}}"
                                                       target="_blank">
                                                        <img class="object-cover h-[100px] rounded-lg"
                                                             src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'height' => 100])}}"
                                                             alt="{{$post->featuredImage()->original_name}}"
                                                             height="50">
                                                    </a>
                                                </figure>
                                                <div class="text-left">
                                                    <a href="{{route_as(Routes::admin_posts_edit, $post)}}"
                                                       class="font-bold">{{$post->title}}</a>
                                                    <p>{{$post->authors->first()->name}}</p>
                                                    <p>{{$post->subtitle}}</p>
                                                    @if($post->published_at !== null)
                                                        <p>{{$post->published_at?->format('d/m/Y')}}</p>
                                                        <p>Words: {{$post->published_word_count}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                @if($post->published_at === null)
                                                    <form action="{{route_as(Routes::admin_posts_publish, $post)}}"
                                                          method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$post->id}}">
                                                        <button type="submit" class="btn btn-xs">Publish</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </th>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">
                                        <p>{{$post->views()->count()}}</p>
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
