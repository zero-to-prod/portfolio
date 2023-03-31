<?php

use App\Http\Controllers\Api\SubscribeResponse;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;

/* @var Tag $tag */
/* @var string $token */

$email = SubscribeResponse::email;
?>
<x-main :tags="$tags" :title="'Newsletter' . ' | ' . config('app.name')" :description="'Subscribe to our newsletter'">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name(Str::title(to()->newsletter->name))->url(to()->newsletter())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="text-center pt-10 2col:pt-16 pb-32 max-w-3xl mx-auto space-y-10 px-2">
        <h1 class="text-6xl">Weekly Newsletter</h1>
        <div>
            <h2 class="text-2xl font-semibold">Want the best content?</h2>
            <p class="text-lg max-w-md mx-auto pt-4">
                We curate the best new information and deliver it to your inbox every Sunday morning.
            </p>
        </div>
        <div class="my-12">
            <div id="cta-expanded" class="p-4 rounded-lg bg-gray-100 border shadow">
                <div class="max-w-md mx-auto">
                    <p class="font-bold text-xl pt-4">The bleeding edge - to your inbox.</p>
                    <livewire:newsletter/>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">
                Get the latest updates on these topics with our newsletter:
            </h2>
            <div class="flex flex-wrap justify-center mt-4">
                @forEach($tags as $tag)
                    <p class="p-2 flex">
                        @if($tag->file !== null)
                            <x-img class="w-10" :file="$tag->file" :width="80" :title="$tag->name" :alt="$tag->name"/>
                        @endif
                        <span class="ml-2 my-auto">{{$tag->name}}</span>
                    </p>
                @endforeach
            </div>
        </div>
    </div>
        @push('data')
            <livewire:styles/>
        @endpush
        @push('scripts')
            <livewire:scripts/>
        @endpush
</x-main>
