<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="David Smith Blog">
    <title>davidDESIGN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<x-top-nav/>
<main class="mx-auto">
    {{$slot}}
</main>
</body>
</html>
