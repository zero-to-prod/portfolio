@php use App\Http\Controllers\Auth\WebLoginRedirect; @endphp
@props(['title'])
<?php
$email = WebLoginRedirect::email;
$password = WebLoginRedirect::password;
?>
        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="devRED dev red">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
</head>
<body class="min-h-screen text-base-content bg-base-200">
<main aria-label="Main">
    <div class="bg-primary-content">
        <div class="mx-auto flex max-w-7xl">
            <x-a class="px-2 py-4 btn-ghost" :href="to()->web->welcome()">
                <x-logo/>
            </x-a>
        </div>
    </div>
    <div class="mt-12 flex flex-col items-center 2col:justify-center px-4">
        <div class="w-full overflow-hidden bg-white shadow-md 2col:max-w-md rounded-lg border border-gray-300">
            <div class="border-b border-gray-300 p-4 text-sm bg-base-200">
                Sign In
            </div>
            <form class="p-4 space-y-4" method="POST" action="{{ to()->web->loginStore() }}">
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
                        <p>{{ $errors->first($email) }}</p>
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
                        <p>{{ $errors->first($password) }}</p>
                    @endif
                </x-form-control>
                <div class="flex flex-row-reverse">
                    <button class="btn btn-xs">Log in</button>
                </div>
            </form>
            <x-divider class="!block"/>
            <div class="mt-4 p-4 space-y-2">
                <a class="btn btn-wide bg-[#24292f] flex hover:bg-[#24292fdb]" href="{{to()->auth->github->index()}}">
                    <x-svg class="h-6 w-6" :name="'github'"/>
                    <span class="mx-auto">Sign In With GitHub</span>
                </a>
            </div>
        </div>
    </div>
</main>
</body>
</html>

