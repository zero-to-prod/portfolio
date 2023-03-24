<?php

use App\Http\Controllers\Admin\Post\PostPublish;
use App\Models\Post;
use App\Models\Tag;

/* @var Post $post */
?>

<x-app-layout>
    <div class="mt-12 mx-auto max-w-7xl bg-gray-800 py-10 sm:rounded-lg">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center flex-row-reverse">
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{to()->admin->post->create()}}" class="btn btn-xs">
                        New Post
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
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Image
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Posts
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Views
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Tags
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Link
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold text-white">Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach($posts as $post)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                        @if($post->file !== null)
                                            <div class="flex justify-between">
                                                <div class="flex  gap-4">
                                                    <figure>
                                                        <a class="underline" href="{{to()->read($post)}}"
                                                           target="_blank">
                                                            <x-img class="object-cover h-[100px] rounded-lg"
                                                                   :file="$post->file"
                                                                   :height="100"
                                                                   :title="''"/>
                                                        </a>
                                                    </figure>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-3 text-sm text-gray-300 max-w-md">
                                        <div>
                                            <div>
                                                <div>
                                                    <a href="{{to()->admin->post->edit($post)}}"
                                                       class="font-bold">{{$post->title}}</a>
                                                    <p>{{$post->authors->first()->name}}</p>
                                                    <p title="{{$post->subtitle}}">{{$post->subtitle}}</p>
                                                    @if($post->isPublished())
                                                        <p>{{$post->original_publish_date?->format('m/d/Y')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">
                                        <p>{{$post->views}}</p>
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-300">
                                        <p>
                                            {{$post->tags->implode(Tag::name, ', ')}}
                                        </p>
                                    </td>

                                    <td class="break-all text-xs max-w-xs text-white">
                                        [![{{$post->file->original_name}}](/file/{{$post->file->name}}?width=250)]({{$post->slug}})
                                        [{{$post->title}}]({{$post->slug}})
                                    </td>
                                    <td>
                                        <div class="my-auto">
                                            @if($post->isNotPublished())
                                                <form action="{{to()->admin->post->publish($post)}}"
                                                      method="post">
                                                    @csrf
                                                    <input name="{{PostPublish::id}}"
                                                           type="hidden"
                                                           value="{{$post->id}}">
                                                    <button class="btn btn-xs">Publish</button>
                                                </form>
                                            @endif
                                        </div>
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
