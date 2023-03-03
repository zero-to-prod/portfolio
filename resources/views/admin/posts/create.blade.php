<?php

use App\Http\Routes;
use App\Models\Author;
use App\Models\Post;

/* @var Post $post */
$post = null;
$author = null;

if (request()->post !== null) {
    $post = Post::where(Post::slug, request()->post)->first();
    $author = $post->authors->first();
}
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
                <div class="flex flex-col mx-auto my-8 max-w-xl px-4">
                    <div class="flex justify-between">
                        <div>
                            <a class="btn btn-xs bg-gray-600 hover:bg-gray-500"
                               href="{{route_as(Routes::blog_post, $post)}}"
                               target="_blank">
                                View
                            </a>
                        </div>

                        <form action="{{route_as(Routes::admin_posts_publish, $post)}}"
                              method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$post->id}}">
                            @if($post->published_at === null)
                                <button type="submit" class="btn btn-xs">Publish</button>
                            @else
                                <button type="submit" class="btn btn-xs bg-gray-600 hover:bg-gray-500">Re-Publish</button>
                            @endif
                        </form>
                    </div>

                    <form action="{{route_as(Routes::admin_posts_store)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input hidden name="id" value="{{$post?->id}}"/>
                            </label>
                            <x-form-control-dark>
                                <label for="{{Post::title}}">Title*</label>
                                <input value="{{$post?->title}}" type="text" name="{{Post::title}}" id="{{Post::title}}"
                                       autocomplete="organization">
                                @if($errors->has(Post::title))
                                    <p>{{ $errors->first(Post::title) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{Author::name}}">Author</label>
                                <select type="text" name="{{Author::name}}" id="{{Author::name}}"
                                        autocomplete="organization" class="bg-gray-900 rounded-md ring-gray-700">
                                    @foreach(Author::all() as $a)
                                        <option {{$author?->id === $a->id ? 'selected' :null}} value="{{$a->id}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has(Author::name))
                                    <p>{{ $errors->first(Author::name) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{Post::body}}">Body</label>
                                <textarea name="{{Post::body}}" id="{{Post::body}}" rows="4">{{$post?->body}}</textarea>
                                @if($errors->has(Post::body))
                                    <p>{{ $errors->first(Post::body) }}</p>
                                @endif
                            </x-form-control-dark>


                            <div class="flex space-x-6 sm:col-span-2">
                                <img class="object-cover h-[100px] rounded-lg"
                                     src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'height' => 100])}}"
                                     alt="{{$post->featuredImage()->original_name}}"
                                     height="50">
                                <x-form-control-dark>
                                    <label for="file">Featured Image</label>
                                    <input class="w-full" type="file" name="file" id="file">
                                    @if($errors->has('file'))
                                        <p>{{ $errors->first('file') }}</p>
                                    @endif
                                </x-form-control-dark>
                            </div>

                        </div>
                        <div class="mt-6">
                            <button type="submit" class="btn btn-wide">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
