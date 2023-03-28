<?php

use App\Http\Requests\Auth\LoginRequest;
use Spatie\SchemaOrg\Schema;

$email = LoginRequest::email;
$password = LoginRequest::password;
$remember = LoginRequest::remember;
?>
<x-login :title="'Sign In' . ' | ' . config('app.name')" :description="'Login to DevLeak'">
    @push('data')
        <?php
            $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Login')->url(to()->login->index())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="border-b border-gray-300 text-sm bg-base-200 p-4">
        Sign in
    </div>
    <div class="p-4 space-y-4">
        <div class="space-y-2">
            <a class="btn btn-wide bg-[#24292f] flex hover:bg-[#24292fdb]"
               href="{{to()->auth->github->index()}}">
                <x-svg class="h-6 w-6" :name="'github'"/>
                <span class="mx-auto">Continue With GitHub</span>
            </a>
        </div>
        <div class="relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-2 text-sm text-gray-500">Or use your email address</span>
            </div>
        </div>
        <form class="space-y-4" method="POST" action="{{ to()->login->store() }}">
            @csrf
            <x-form-control>
                <label for="{{$email}}">Email*</label>
                <input name="{{$email}}"
                       id="{{$email}}"
                       value="{{old($email)}}"
                       type="email"
                       autocomplete="email"
                >
                @if($errors->has($email))
                    <p class="!text-red-500">{{ $errors->first($email) }}</p>
                @endif
            </x-form-control>
            <x-form-control>
                <label for="{{$password}}">Password*</label>
                <input name="{{$password}}"
                       id="{{$password}}"
                       value="{{old($password)}}"
                       type="password"
                       autocomplete="password"
                >
                @if($errors->has($password))
                    <p class="!text-red-500">{{ $errors->first($password) }}</p>
                @endif
            </x-form-control>
            <div>
                <input class="rounded"
                        name="{{$remember}}"
                       id="{{$remember}}"
                       value="{{old($remember)}}"
                       type="checkbox"
                >
                <label class="text-sm font-bold" for="{{$remember}}">Remember me</label>
                @if($errors->has($remember))
                    <p class="!text-red-500">{{ $errors->first($remember) }}</p>
                @endif
            </div>
            <button class="btn btn-wide">Continue</button>
        </form>
    </div>
</x-login>

