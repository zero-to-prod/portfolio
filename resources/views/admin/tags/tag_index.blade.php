<?php

use App\Models\Tag;
use Illuminate\Support\Collection;

/* @var Tag $tag */
/* @var Collection<Tag, Tag> $tags */
?>

<x-app-layout>
    <div class="mt-12 mx-auto max-w-7xl bg-gray-800 py-10 sm:rounded-lg">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center flex-row-reverse">
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{to()->admin->tag->create()}}" class="btn btn-xs">
                        New Tag
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-700 text-white">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold">Tag
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold">Views
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold">Post Count
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach($tags as $tag)
                                <tr>
                                    <td class="p-3.5">
                                        <a class="flex justify-between"
                                           href="{{to()->admin->tag->edit($tag)}}">
                                            <div class="flex gap-4">
                                                @if($tag->file)
                                                    <x-img class="object-cover w-[100px] rounded-lg"
                                                           :file="$tag->file"
                                                           :height="100"
                                                           :title="''"/>
                                                @endif
                                                <div>
                                                    <p class="font-bold">
                                                        {{$tag->name}}
                                                    </p>
                                                    <p>
                                                        {{$tag->slug}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="p-3.5">
                                        {{$tag->views}}
                                    </td>
                                    <td class="p-3.5">
                                        {{$tag->posts_count}}
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
