<?php

use App\Http\Controllers\Results;
use App\Models\Author;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Spatie\SchemaOrg\Schema;

/* @var Collection<Post, Post> $posts */
/* @var Tag $tag */
/* @var ?Author $author_model */

$title = request()->query(Results::query);
$title = request()->query(Results::topic) ?? $title;
$title = request()->query(Results::topics) !== null ? 'Topics' : $title;
$title = request()->query(Results::popular) !== null ? 'Popular' : $title;
$author_model = null;
?>
<x-main :title="$title . ' | ' . config('app.name')" :description="'Search results for: ' . $title">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Results')->url(to()->results())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="flex flex-col gap-2 max-w-4xl 2col:px-2 mx-auto">
        <div>
            @if($tag !== null)
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    @if($tag->file !== null)
                        <x-img class="w-10 rounded" :file="$tag->file" :width="80"/>
                    @endif
                    <h2 class="my-auto text-lg font-semibold">
                        {{$tag->name}}
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if(request()->query(Results::query) !== null)
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    <x-svg :name="'search'" class="!h-10 !w-10"/>
                    <h2 class="my-auto text-lg font-semibold">
                        Search Results
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if($author_model !== null && request()->query(Results::author) !== null)
                <div class="flex gap-x-2 my-2 ml-2 2col:ml-0">
                    <x-svg :name="'search'" class="!h-10 !w-10"/>
                    <h2 class="my-auto text-lg font-semibold">
                        Authored By: <span class="font-normal">{{$author_model->name}}</span>
                    </h2>
                </div>
                <x-divider/>
            @endif
            @if(request()->query(Results::popular) !== null)
                <div class="mb-2 flex gap-x-2 pt-2 ml-2 2col:ml-0" title="Popular">
                    <x-svg :name="'popular'" class="!h-10 !w-10"/>
                    <h2 class="-mx-1 my-auto text-lg font-semibold">
                        Popular
                    </h2>
                </div>
                <x-divider/>
            @endif
        </div>
        @if($posts !== null && count($posts))
            <x-post-responsive :posts="$posts"/>
    </div>
    @else
        @if($posts !== null && count($posts) === 0)
            <div class="2col:ml-12 flex flex-col mx-auto gap-4 flex-wrap justify-center">
                <h2 class="text-lg">Nothing Found</h2>
            </div>
        @endif
        <div class="2col:ml-12 flex mx-auto gap-4 flex-wrap justify-center">
            @forEach(Tag::getMostViewed() as $tag)
                <x-a class="rounded-lg p-2 hover:bg-gray-100 flex" :href="to()->results($tag)">
                    @if($tag->file !== null)
                        <x-img class="w-10 rounded" :file="$tag->file" :width="80"/>
                    @endif
                    <span class="ml-2 my-auto">{{$tag->name}}</span>
                </x-a>
            @endforeach
        </div>
    @endif
</x-main>