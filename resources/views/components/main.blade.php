<?php

use App\Http\Routes;

?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="David Smith Blog">
    <title>davidDESIGN</title>
    @vite('resources/css/app.css')
</head>
<body>
<nav class="bg-sky-200 sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-4">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <a href="{{Routes::welcome->value}}" class="flex items-center "><span class="text-gray-500">david</span><span class="text-sky-500">DESIGN</span></a>
                <div class="flex space-x-8 ml-6">
                    <a href="{{Routes::welcome->value}}"
                        @class([
                            'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::welcome),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => !route_name_is(Routes::welcome),
                            ])
                    >Home</a>
                    <a href="{{Routes::blog->value}}"
                        @class([
                            'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::blog),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => !route_name_is(Routes::blog),
                            ])
                    >Blog</a>
                </div>
            </div>
            <div class="ml-6 flex items-center">
                <button type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-sky-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                    Contact
                </button>
            </div>
        </div>
    </div>
</nav>
<main class="mx-auto">
    {{$slot}}
</main>
</body>
</html>
