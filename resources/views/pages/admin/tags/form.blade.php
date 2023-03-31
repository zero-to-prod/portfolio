<?php

use App\Http\Controllers\Admin\Tag\TagFormStore;
use App\Models\Tag;

/* @var Tag $tag */

$name = TagFormStore::name;
$logo = TagFormStore::logo;

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col mx-auto my-8 max-w-xl px-4">
                    <form action="{{to()->admin->tag->store()}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input name="{{TagFormStore::id}}"
                                       hidden
                                       value="{{$tag?->id}}"/>
                            </label>
                            <x-form-control-dark>
                                <label for="{{$name}}">Name</label>
                                <input name="{{$name}}"
                                       id="{{$name}}"
                                       value="{{$tag !== null ? $tag->name : old($name)}}"
                                       required>
                                @if($errors->has($name))
                                    <p>{{ $errors->first($name) }}</p>
                                @endif
                            </x-form-control-dark>
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($tag?->file !== null)
                                    <x-img class="object-cover w-[100px] rounded-lg"
                                           :file="$tag->file"
                                           :height="100"
                                           :title="$tag->name"
                                           :alt="$tag->name"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$logo}}">Logo</label>
                                    <input class="w-full"
                                           name="{{$logo}}"
                                           id="{{$logo}}"
                                           {{$tag?->logo !== null ? null  : 'required=true'}}
                                           type="file"
                                    >
                                    @if($errors->has($logo))
                                        <p>{{ $errors->first($logo) }}</p>
                                    @endif
                                </x-form-control-dark>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button class="btn btn-wide">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

