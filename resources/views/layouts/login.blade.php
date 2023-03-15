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
        <div class="mx-auto flex max-w-7xl">
            <x-a class="flex px-2 py-4 text-lg 2col:text-xl font-semibold btn-ghost" :href="to()->web->welcome()">
                <span class="my-auto rounded-l bg-white pr-1 pl-2 shadow text-primary">dev</span>
                <span class="my-auto rounded-r pr-2 pl-1 text-white shadow-md bg-primary">RED</span>
            </x-a>
        </div>
    </div>
    <div class="mt-12 flex flex-col items-center 2col:justify-center px-4">
        <div class="w-full overflow-hidden bg-white shadow-md 2col:max-w-md rounded-lg border border-gray-300">
            <div class="border-b border-gray-300 p-4 text-sm bg-base-200">
                Sign In
            </div>
            <div class="mt-4 p-4">
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

