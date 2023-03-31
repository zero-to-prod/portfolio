<?php

use App\Http\Controllers\Api\SubscribeResponse;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;

/* @var Tag $tag */
/* @var string $token */

$email = SubscribeResponse::email;
?>
<x-main :title="'Newsletter' . ' | ' . config('app.name')" :description="'Subscription Success'">
    @push('data')
        <meta name="robots" content="noindex">
    @endpush
    <div class="text-center pt-10 2col:pt-16 pb-32 max-w-3xl mx-auto px-2">
        <h1 class="text-2xl font-bold">Subscription Success</h1>
        <h2 class="text-xl">You are subscribed to the weekly newsletter</h2>
        <div class="mt-4">
            <x-a :href="to()->welcome()" class="btn">Return to the home page</x-a>
        </div>
    </div>
    @push('data')
        <livewire:styles/>
    @endpush
    @push('scripts')
        <livewire:scripts/>
    @endpush
</x-main>
