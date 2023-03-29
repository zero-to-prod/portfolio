@props(['tags'])
<?php

use App\Helpers\PostTypes;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Spatie\SchemaOrg\Schema;

/* @var Post $post */
/* @var Collection<Tag, Tag> $tags */
?>

<x-main :tags="$tags">
    <h1 class="sr-only">DevLeak Home Page</h1>
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Home')->url(to()->welcome())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="4col:mx-auto flex w-full 4col:max-w-7xl flex-col 2col:px-2">
        @foreach($tags as $tag)
            <section>
                <x-a class="mb-2 2col:mb-0 2col:ml-0 flex gap-x-2 p-2 btn-ghost"
                     :href="to()->results($tag)"
                     title="Topic: {{$tag->name}}"
                >
                    @if($tag->file !== null)
                        <x-img class="my-auto w-10 rounded" :file="$tag->file" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold">
                        {{$tag->name}}
                    </h2>
                </x-a>
                <x-divider class="mt-2 mb-4"/>
                <div class="mb-4 grid grid-flow-row 2col:grid-cols-2 4col:grid-cols-4 2cols:gap-0 2col:gap-2 gap-4 ">
                        <?php
                        [$latest_posts, $older_posts] = $tag->posts->partition(
                            fn(Post $post) => $post->original_publish_date->gt(now()->subDays(3))
                        );
                        ?>
                    @foreach($latest_posts->merge($older_posts) as $post)
                        <x-a class="shadow-lg 2col:shadow-none" :href="to()->read($post)">
                            <div class="relative">
                                <div class="overflow-hidden 2col:rounded-lg aspect-w-3 aspect-h-2">
                                    @if($post->post_type_id === PostTypes::animation)
                                        <x-img class="h-full w-full object-cover object-center opacity-0 2col:opacity-100 hover:opacity-0 z-10"
                                               :file="$post->animationFile"
                                               :width="300"
                                               :title="''"
                                        />
                                        <x-img class="h-full w-full object-cover object-center"
                                               :file="$post->altFile"
                                               :width="300"
                                               :title="''"
                                        />
                                    @else
                                        <x-img class="h-full w-full object-cover object-center"
                                               :file="$post->file"
                                               :width="300"
                                               :title="''"
                                        />
                                    @endif
                                </div>
                                <x-reading-time-chip :post="$post"/>
                                <x-new-chip :post="$post"/>
                            </div>
                            <div class="p-2 2col:px-0 2col:pt-1 ">
                                <h3 class="font-bold leading-5 tracking-tight break-word"
                                    title="{{ $post->title }}">
                                    {{ $post->title }}
                                </h3>
                                <p class="2col:hidden text-sm" title="{{$post->subtitle}}">
                                    {{$post->subtitle}}
                                </p>
                                <p class="2col:mt-0 mt-2 text-sm" title="{{$post->authorList()}}">
                                    {{$post->authorList()}}
                                </p>
                                <x-views-date-line :post="$post"/>
                            </div>
                        </x-a>
                    @endforeach
                </div>
            </section>
    @endforeach
</x-main>
