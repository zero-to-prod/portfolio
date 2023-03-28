<?php

use Spatie\SchemaOrg\Schema;

?>
<x-subscribe class="mx-auto my-4 max-w-7xl 2col:py-8 px-2" :title="'Subscribe' . ' | ' . config('app.name')"
             :description="'Subscribe'">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Subscribe')->url(to()->subscribe())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <x-logo class="mx-auto"/>
    <h1 class="mt-6 text-center text-2xl 2col:text-3xl font-bold">Choose a subscription plan</h1>
    <livewire:subform/>
</x-subscribe>
