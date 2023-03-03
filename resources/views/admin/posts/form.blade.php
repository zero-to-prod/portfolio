<?php

use App\Http\Routes;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;

/* @var Tag $tag */
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
                        @isset($post)
                            <form action="{{route_as(Routes::admin_posts_publish, $post)}}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$post->id}}">
                                @if($post->isPublished())
                                    <button type="submit" class="btn btn-xs bg-gray-600 hover:bg-gray-500">Re-Publish
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-xs">Publish</button>
                                @endif
                            </form>
                            @if($post->isPublished())
                                <a class="btn btn-xs"
                                   href="{{route_as(Routes::blog_post, $post)}}"
                                   target="_blank">
                                    View
                                </a>
                            @endif
                        @endisset
                    </div>

                    <form action="{{route_as(Routes::admin_posts_store)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input hidden name="id" value="{{$post?->id}}"/>
                            </label>
                            <x-form-control-dark>
                                <label for="{{Post::title}}">Title</label>
                                <input value="{{$post !== null ? $post->title : old(Post::title)}}"
                                       required
                                       type="text"
                                       name="{{Post::title}}" id="{{Post::title}}"
                                       autocomplete="organization">
                                @if($errors->has(Post::title))
                                    <p>{{ $errors->first(Post::title) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{Author::name}}">Author</label>
                                <select type="text"
                                        multiple
                                        required
                                        name="authors[]"
                                        id="{{Author::name}}"
                                        autocomplete="organization"
                                        class="bg-gray-900 rounded-md ring-gray-700">
                                    @foreach(Author::all() as $tag)
                                        <option {{$author?->id === $tag->id ? 'selected' :null}} value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('authors'))
                                    <p>{{ $errors->first('authors') }}</p>
                                @endif
                            </x-form-control-dark>
                            <div class="sm:col-span-2">
                                <p class="text-white mb-3">Tags</p>
                                <div class="flex gap-4 flex-wrap">
                                    @foreach(Tag::all() as $tag)
                                        <div class="flex items-center text-white space-x-2">
                                            <input id="tag-{{$tag->id}}"
                                                   {{$post?->tags->where(Tag::slug, $tag->slug)->count() ? 'checked' : null}} type="checkbox"
                                                   name="tags[]" value="{{$tag->id}}"
                                                   class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-600"
                                            />
                                            <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                                        </div>
                                    @endforeach
                                    @if($errors->has('tags'))
                                        <p class="error">{{ $errors->first('tags') }}</p>
                                    @endif
                                </div>
                            </div>

                            <x-form-control-dark>
                                <label for="{{Post::body}}">Body</label>
                                <textarea name="{{Post::body}}"
                                          required
                                          id="{{Post::body}}"
                                          rows="4">{{$post !== null ? $post->body : old(Post::body)}}</textarea>
                                @if($errors->has(Post::body))
                                    <p>{{ $errors->first(Post::body) }}</p>
                                @endif
                            </x-form-control-dark>

                            <div class="flex space-x-6 sm:col-span-2">
                                @if($post?->featuredImage() !== null)
                                    <img class="object-cover h-[100px] rounded-lg"
                                         src="{{ route_as(Routes::file, ['file' => $post->featuredImage()->name, 'height' => 100])}}"
                                         alt="{{$post->featuredImage()->original_name}}"
                                         height="50">
                                @endif
                                <x-form-control-dark>
                                    <label for="file">Featured Image</label>
                                    <input {{$post?->featuredImage() !== null ? null  : 'required=true'}} class="w-full"
                                           type="file"
                                           name="file" id="file">
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
