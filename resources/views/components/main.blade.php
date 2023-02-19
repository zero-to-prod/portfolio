<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="David Smith Blog">
    <title>davidDESIGN</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<x-top-nav/>
<main>
    {{$slot}}
</main>
</body>
</html>
