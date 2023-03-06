<?php

use App\Helpers\Routes;
use App\Http\Controllers\Admin\Post\PostFormRedirect;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;

/* @var Tag $author_model */
/* @var Post $post_model */

$title = PostFormRedirect::title;
$subtitle = PostFormRedirect::subtitle;
$authors = PostFormRedirect::authors;
$tags = PostFormRedirect::tags;
$body = PostFormRedirect::body;
$featured_image = PostFormRedirect::featured_image;

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
                        @isset($post_model)
                            <form action="{{route_as(Routes::admin_post_publish, $post_model)}}" method="post">
                                @csrf
                                <input name="{{PostPublishRedirect::id}}" type="hidden" value="{{$post_model->id}}">
                                @if($post_model->isPublished())
                                    <button class="btn btn-xs bg-gray-600 hover:bg-gray-500">
                                        Re-Publish
                                    </button>
                                @else
                                    <button class="btn btn-xs"> Publish</button>
                                @endif
                            </form>
                            @if($post_model->isPublished())
                                <a class="btn btn-xs"
                                   href="{{route_as(Routes::read, $post_model)}}"
                                   target="_blank">
                                    View
                                </a>
                            @endif
                        @endisset
                    </div>

                    <form action="{{route_as(Routes::admin_post_store)}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input name="{{PostFormRedirect::id}}"
                                       hidden
                                       value="{{$post_model?->id}}"/>
                            </label>
                            <x-form-control-dark>
                                <label for="{{$title}}">Title</label>
                                <input name="{{$title}}"
                                       id="{{$title}}"
                                       value="{{$post_model !== null ? $post_model->title : old($title)}}"
                                       required>
                                @if($errors->has($title))
                                    <p>{{ $errors->first($title) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$subtitle}}">Subtitle</label>
                                <textarea name="{{$subtitle}}"
                                          id="{{$subtitle}}"
                                          required
                                          rows="2">
{{$post_model !== null ? $post_model->subtitle : old($subtitle)}}
                                </textarea>
                                @if($errors->has($subtitle))
                                    <p>{{ $errors->first($subtitle) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$authors}}">Author</label>
                                <select class="bg-gray-900 rounded-md ring-gray-700"
                                        name="{{$authors}}"
                                        id="{{$authors}}"
                                        multiple
                                        required>
                                    @foreach(Author::all() as $author_model)
                                        <option {{$author_model?->id === $author_model->id ? 'selected' :null}} value="{{$author_model->id}}">
                                            {{$author_model->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has($authors))
                                    <p>{{ $errors->first($authors) }}</p>
                                @endif
                            </x-form-control-dark>
                            <div class="sm:col-span-2">
                                <p class="text-white mb-3">Tags</p>
                                <div class="flex gap-4 flex-wrap">
                                    @foreach(Tag::withType()->whereNull(Tag::type)->get() as $author_model)
                                        <div class="flex items-center text-white space-x-2">
                                            <input class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-600"
                                                   name="{{$tags}}"
                                                   id="tag-{{$author_model->id}}"
                                                   value="{{$author_model->id}}"
                                                   type="checkbox"
                                                    {{$post_model?->tags->where(Tag::slug, $author_model->slug)->count() ? 'checked' : null}}
                                            />
                                            <label for="tag-{{$author_model->id}}">{{$author_model->name}}</label>
                                        </div>
                                    @endforeach
                                    @if($errors->has($tags))
                                        <p class="error">{{ $errors->first($tags) }}</p>
                                    @endif
                                </div>
                            </div>
                            <x-form-control-dark>
                                <label for="{{$body}}">Body</label>
                                <textarea name="{{$body}}"
                                          id="{{$body}}"
                                          required
                                          rows="4">
{{$post_model !== null ? $post_model->body : old($body)}}
                                </textarea>
                                @if($errors->has($body))
                                    <p>{{ $errors->first($body) }}</p>
                                @endif
                            </x-form-control-dark>
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($post_model?->hasFeaturedImage())
                                    <x-img class="object-cover h-[100px] rounded-lg"
                                           :file="$post_model->featuredImage()"
                                           :height="100"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$featured_image}}">Featured Image</label>
                                    <input class="w-full"
                                           name="{{$featured_image}}"
                                           id="{{$featured_image}}"
                                           {{$post_model?->hasFeaturedImage() ? null  : 'required=true'}}
                                           type="file"
                                    >
                                    @if($errors->has($featured_image))
                                        <p>{{ $errors->first($featured_image) }}</p>
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

