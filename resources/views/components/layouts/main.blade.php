<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="davidDESIGN david design">
    <title>{{ $title ?? config('app.name', 'Home') }}</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon/favicon.ico') }}">
</head>
<body>
<x-top-nav/>
<main aria-label="Main Content">
    {{$slot}}
</main>
</body>
</html>
