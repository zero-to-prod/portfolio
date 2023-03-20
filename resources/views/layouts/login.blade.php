@props(['title'])
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
        <div class="mx-auto flex justify-between max-w-7xl">
            <x-a class="px-2 py-4 btn-ghost" :href="to()->welcome()">
                <x-logo/>
            </x-a>
            <div class="my-auto px-2">
                <x-a :href="to()->web->register->index()"
                     title="Go to Sign In Page"
                     class="btn">
                    <span>Create</span> <span>account</span></x-a>
            </div>
        </div>
    </div>
    <div class="mt-12 flex flex-col items-center 2col:justify-center px-4">
        <div class="w-full overflow-hidden bg-white shadow-md 2col:max-w-md rounded-lg border border-gray-300">
            {{$slot}}
        </div>
    </div>
</main>
</body>
</html>

