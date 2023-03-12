<?php

use App\Helpers\R;
use App\Models\Author;
use Illuminate\Support\Collection;

/* @var Author $author */
/* @var Collection<Author> $authors */
?>

<x-app-layout>
    <div class="mt-12 mx-auto max-w-7xl bg-gray-800 py-10 sm:rounded-lg">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center flex-row-reverse">
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{to()->admin->author->create()}}" class="btn btn-xs">
                        New Author
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-700 text-neutral-content">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold">Tag
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-3 text-left text-sm font-semibold">Post Count
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                            @foreach($authors as $author)
                                <tr>
                                    <td class="p-3.5">
                                        <a class="flex justify-between"
                                           href="{{to()->admin->author->edit($author)}}">
                                            <div class="flex gap-4 h-[100px]">
                                                @if($author->avatar())
                                                    <x-img class="object-cover rounded-lg"
                                                           :file="$author->avatar()"
                                                           :height="100"
                                                           :title="''"/>
                                                @endif
                                                <div>
                                                    <p class="font-bold">
                                                        {{$author->name}}
                                                    </p>
                                                    <p>
                                                        {{$author->slug}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="p-3.5">
                                        {{$author->posts()->count()}}
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
