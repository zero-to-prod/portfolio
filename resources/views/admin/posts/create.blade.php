<?php

use App\Http\Routes;
use App\Models\Author;
use App\Models\Post;

/* @var Post $post */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route_as(Routes::admin_posts_store)}}" method="post" enctype="multipart/form-data"
                      class="mx-auto my-8 space-y-8 max-w-xl">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                        <x-form-control-dark>
                            <label for="{{Post::title}}">Title*</label>
                            <input value="{{old(Post::title)}}" type="text" name="{{Post::title}}" id="{{Post::title}}"
                                   autocomplete="organization">
                            @if($errors->has(Post::title))
                                <p>{{ $errors->first(Post::title) }}</p>
                            @endif
                        </x-form-control-dark>
                        <x-form-control-dark>
                            <label for="{{Author::name}}">Author</label>
                            <select type="text" name="{{Author::name}}" id="{{Author::name}}"
                                    autocomplete="organization" class="bg-gray-900 rounded-md ring-gray-700">
                                @foreach(Author::all() as $author)
                                    <option {{old(Author::name) === $author->id ? 'selected' :null}} value="{{$author->id}}">{{$author->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has(Author::name))
                                <p>{{ $errors->first(Author::name) }}</p>
                            @endif
                        </x-form-control-dark>
                        <x-form-control-dark>
                            <label for="{{Post::body}}">Body</label>
                            <textarea name="{{Post::body}}" id="{{Post::body}}" rows="4">{{old(Post::body)}}</textarea>
                            @if($errors->has(Post::body))
                                <p>{{ $errors->first(Post::body) }}</p>
                            @endif
                        </x-form-control-dark>
                        <x-form-control-dark>
                            <label for="file">Featured Image</label>
                            <input type="file" name="file" id="file">
                            @if($errors->has('file'))
                                <p>{{ $errors->first('file') }}</p>
                            @endif
                        </x-form-control-dark>
                    </div>
                    <button type="submit" class="btn btn-wide">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
