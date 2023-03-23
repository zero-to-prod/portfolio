<?php

use App\Models\User;

/* @var User $user */
?>
<x-subscribe class="mx-auto my-4 max-w-7xl 2col:py-8 px-2 text-center" :title="'Subscribe'">
    <x-logo class="mx-auto"/>
    <h1 class="mt-6 text-2xl 2col:text-3xl font-bold">Thank you for subscribing</h1>
    <p>Your subscription is fully activated.</p>
    <div class="mt-8">
        <x-a :href="to()->welcome()" class="btn">Return to the homepage</x-a>
    </div>
</x-subscribe>
