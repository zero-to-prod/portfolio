@props(['title', 'tags' => null])

        <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DevLeak dev leak">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
    <livewire:styles />
</head>
<body class="min-h-screen overflow-y-scroll antialiased bg-primary-content text-base-content">
<main aria-label="Main" {{$attributes->merge(['class' => ''])}}>
{{ $slot}}
</main>
<livewire:scripts />
</body>
</html>

