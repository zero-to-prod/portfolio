<?php

use App\Helpers\PostTypes;
use App\Helpers\TagTypes;
use App\Http\Controllers\Admin\Post\PostStore;
use App\Http\Controllers\Admin\Post\PostPublish;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;

/* @var Tag $author_model */
/* @var Post $post_model */
/* @var File $file */

$title = PostStore::title;
$type = PostStore::type;
$subtitle = PostStore::subtitle;
$authors = PostStore::authors;
$tags = PostStore::tags;
$public_content = PostStore::public_content;
$cta = PostStore::cta;
$exclusive_content = PostStore::exclusive_content;
$featured_image = PostStore::featured_image;
$alt_image = PostStore::alt_image;
$animation_image = PostStore::animation_image;
$in_body = PostStore::in_body;
?>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col mx-auto my-8 max-w-xl px-4">
                    <div class="flex justify-between">
                        @isset($post_model)
                            <form action="{{to()->admin->post->publish($post_model)}}" method="post">
                                @csrf
                                <input name="{{PostPublish::id}}" type="hidden" value="{{$post_model->id}}">
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
                                   href="{{to()->read($post_model)}}"
                                   target="_blank">
                                    View
                                </a>
                            @endif
                        @endisset
                    </div>
                    <form action="{{to()->admin->post->store()}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <label>
                                <input name="{{PostStore::id}}"
                                       hidden
                                       value="{{$post_model?->id}}"/>
                            </label>
                            <div class="col-span-2 gap-2 flex">
                                <fieldset>
                                    <legend class="text-white">Post Type:</legend>
                                    @foreach(PostTypes::cases() as $post_type)
                                        <label class="text-white">
                                            <input type="radio" id="{{$post_type->value}}" name="{{$type}}"
                                                   value="{{$post_type->value}}" {{$post_type === $post_model?->post_type_id ? 'checked' : null}}>
                                            <span>{{$post_type->name}}</span>
                                        </label>
                                    @endforeach
                                </fieldset>
                            </div>
                            @if($post_model?->file !== null)
                                <x-form-control-dark>
                                    <label>Post Markdown Link</label>
                                    <span class="text-sm text-white">
                                    [![{{$post_model->file->original_name}}](/file/{{$post_model->file->name}}?width=250)]({{$post_model->slug}})
                                    [{{$post_model->title}}]({{$post_model->slug}})
                                </span>
                                </x-form-control-dark>
                            @endif
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($post_model?->file !== null)
                                    <x-img class="object-cover w-[100px] rounded-lg"
                                           :file="$post_model->file"
                                           :height="100"
                                           :title="$post_model->title"
                                           :alt="$post_model->title"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$featured_image}}">Featured Image</label>
                                    <input class="w-full"
                                           name="{{$featured_image}}"
                                           id="{{$featured_image}}"
                                           {{$post_model?->file !== null ? null  : 'required=true'}}
                                           type="file"
                                    >
                                    @if($errors->has($featured_image))
                                        <p>{{ $errors->first($featured_image) }}</p>
                                    @endif
                                </x-form-control-dark>
                            </div>
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($post_model?->animationFile !== null)
                                    <x-img class="object-cover w-[100px] rounded-lg"
                                           :file="$post_model->animationFile"
                                           :height="100"
                                           :title="$post_model->title"
                                           :alt="$post_model->title"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$animation_image}}">Animation Image</label>
                                    <input class="w-full"
                                           name="{{$animation_image}}"
                                           id="{{$animation_image}}"
                                           type="file"
                                    >
                                    @if($errors->has($animation_image))
                                        <p>{{ $errors->first($animation_image) }}</p>
                                    @endif
                                </x-form-control-dark>
                            </div>
                            <div class="flex space-x-6 sm:col-span-2">
                                @if($post_model?->altFile !== null)
                                    <x-img class="object-cover w-[100px] rounded-lg"
                                           :file="$post_model->altFile"
                                           :title="$post_model->title"
                                           :alt="$post_model->title"
                                           :height="100"
                                    />
                                @endif
                                <x-form-control-dark>
                                    <label for="{{$alt_image}}">Alt Image</label>
                                    <input class="w-full"
                                           name="{{$alt_image}}"
                                           id="{{$alt_image}}"
                                           type="file"
                                    >

                                    @if($errors->has($alt_image))
                                        <p>{{ $errors->first($alt_image) }}</p>
                                    @endif
                                </x-form-control-dark>
                            </div>
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
                            <div class="sm:col-span-2">
                                <p class="text-neutral-content mb-3">Authors</p>
                                <div class="flex gap-4 flex-wrap">
                                    @foreach(Author::all() as $author_model)
                                        <div class="flex items-center text-white space-x-2">
                                            <input class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                                   name="{{$authors}}"
                                                   id="tag-{{$author_model->id}}"
                                                   value="{{$author_model->id}}"
                                                   type="checkbox"
                                                    {{$post_model?->authors->where(Author::id, $author_model->id)->count() ? 'checked' : null}}
                                            />
                                            <label for="tag-{{$author_model->id}}">{{$author_model->name}}</label>
                                        </div>
                                    @endforeach
                                    @if($errors->has($authors))
                                        <p class="error">{{ $errors->first($authors) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-neutral-content mb-3">Tags</p>
                                <div class="flex gap-4 flex-wrap">
                                    @foreach(Tag::withType(TagTypes::post->value)->get() as $tag_model)
                                        <div class="flex items-center text-white space-x-2">
                                            <input class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                                   name="{{$tags}}"
                                                   id="tag-{{$tag_model->id}}"
                                                   value="{{$tag_model->id}}"
                                                   type="checkbox"
                                                    {{$post_model?->tags->where(Tag::slug, $tag_model->slug)->count() ? 'checked' : null}}
                                            />
                                            <label for="tag-{{$tag_model->id}}">{{$tag_model->name}}</label>
                                        </div>
                                    @endforeach
                                    @if($errors->has($tags))
                                        <p class="error">{{ $errors->first($tags) }}</p>
                                    @endif
                                </div>
                            </div>
                            <x-form-control-dark>
                                <label for="{{$public_content}}">Public Content</label>
                                <textarea name="{{$public_content}}"
                                          id="{{$public_content}}"
                                          required
                                          rows="4">
{{$post_model !== null ? $post_model->public_content : old($public_content)}}
                                </textarea>
                                @if($errors->has($public_content))
                                    <p>{{ $errors->first($public_content) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$cta}}">CTA</label>
                                <textarea name="{{$cta}}"
                                          id="{{$cta}}"
                                          required
                                          rows="4">
{{$post_model !== null ? $post_model->cta : old($cta)}}
                                </textarea>
                                @if($errors->has($cta))
                                    <p>{{ $errors->first($cta) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$exclusive_content}}">Exclusive Content</label>
                                <textarea name="{{$exclusive_content}}"
                                          id="{{$exclusive_content}}"
                                          required
                                          rows="4">
{{$post_model !== null ? $post_model->exclusive_content : old($exclusive_content)}}
                                </textarea>
                                @if($errors->has($exclusive_content))
                                    <p>{{ $errors->first($exclusive_content) }}</p>
                                @endif
                            </x-form-control-dark>
                            <x-form-control-dark>
                                <label for="{{$in_body}}">In-Body Images</label>
                                <input class="w-full"
                                       name="{{$in_body}}"
                                       id="{{$in_body}}"
                                       type="file"
                                />
                                @if($errors->has($in_body))
                                    <p>{{ $errors->first($in_body) }}</p>
                                @endif
                            </x-form-control-dark>
                            @if($post_model?->inBodyFiles()->count())
                                @foreach($post_model->inBodyFiles() as $file)
                                    <div class="flex space-x-6 sm:col-span-2">
                                        <x-img class="object-cover w-[100px] rounded-lg"
                                               :file="$file"
                                               :height="100"
                                        />
                                        <p class=" text-white">
                                            ![{{$file->original_name}}](/file/{{$file->name}})
                                        </p>
                                    </div>
                                @endforeach
                            @endif
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

