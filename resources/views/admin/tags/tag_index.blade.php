<?php

use App\Helpers\Routes;
use App\Helpers\Views;
use App\Models\Tag;
use Illuminate\Support\Collection;

/* @var Tag $tag */
/* @var Collection<Tag> $tags */
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
                    <a href="{{route_as(Routes::admin_tag_create)}}" class="btn btn-xs">
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
                                        <div class="flex justify-between">
                                            <div class="flex gap-4 h-[100px] w-[100px]">
                                                @if($tag->logo())
                                                    <x-img class="object-cover h-[100px] rounded-lg"
                                                           :file="$tag->logo()"
                                                           :height="100"
                                                           :title="''"/>
                                                @endif
                                                <div>
                                                    <p class="font-bold">
                                                        <a href="{{route_as(Routes::admin_tag_edit, [$tag])}}">
                                                            {{$tag->name}}
                                                        </a>
                                                    </p>
                                                    <p>
                                                        {{$tag->slug}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
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
