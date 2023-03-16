<?php

use App\Http\Controllers\Admin\Author\AuthorFormRedirect;
use App\Models\Author;

/* @var Author $author */

$name = AuthorFormRedirect::name;
$title = AuthorFormRedirect::title;
$avatar = AuthorFormRedirect::avatar;

?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col mx-auto my-8 max-w-xl px-4">
                    <form action="{{to()->admin->author->store()}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input name="{{AuthorFormRedirect::id}}"
                                       hidden
                                       value="{{$author?->id}}"/>
                            </label>
                            <x-form-control-dark>
                                <label for="{{$name}}">Name</label>
                                <input name="{{$name}}"
                                       id="{{$name}}"
                                       value="{{$author !== null ? $author->name : old($name)}}"
                                       required>
                                @if($errors->has($name))
                                    <p>{{ $errors->first($name) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$title}}">Title</label>
                                <input name="{{$title}}"
                                       title="{{$title}}"
                                       id="{{$title}}"
                                       value="{{$author !== null ? $author->title : old($title)}}"
                                       required>
                                @if($errors->has($title))
                                    <p>{{ $errors->first($title) }}</p>
                                @endif
                            </x-form-control-dark>
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($author?->file)
                                    <x-img class="object-cover h-[100px] rounded-lg"
                                           :file="$author->file"
                                           :height="100"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$avatar}}">Avatar</label>
                                    <input class="w-full"
                                           name="{{$avatar}}"
                                           id="{{$avatar}}"
                                           {{$author?->file !== null ? null  : 'required=true'}}
                                           type="file"
                                    >
                                    @if($errors->has($avatar))
                                        <p>{{ $errors->first($avatar) }}</p>
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

