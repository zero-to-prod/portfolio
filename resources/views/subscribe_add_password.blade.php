<?php

use App\Models\User;

/* @var User $user */
?>
<x-subscribe class="mx-auto my-4 max-w-7xl 2col:py-8 px-2" :title="'Subscribe'">
    <x-logo class="mx-auto"/>
    <h1 class="mt-6 text-center text-2xl 2col:text-3xl font-bold">One more thing</h1>
    <h2 class="mt-6 text-center text-xl 2col:text-xl">Add a password to access your subscription</h2>
    <h3 class="font-bold text-center my-6">{{$user->email}}</h3>
    <livewire:add-password :user="$user"/>
</x-subscribe>
