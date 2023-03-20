<?php

use App\Helpers\Routes;

?>

<nav aria-label="Top Navigation Bar" id="nav"
     class="sticky top-0 z-50 bg-sky-200 transition-all duration-500 hover:shadow">
    <div class="mx-auto max-w-7xl px-2 lg:px-0">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex">
                    <a aria-label="Home Page" href="{{route_as(to()->web->welcome)}}"
                            @class([
                                'inline-flex items-center border-b-2 sm:text-lg text-gray-600',
                                'border-primary' => route_name_is(to()->web->welcome),
                                'border-transparent hover:border-gray-300 hover:text-gray-700' => route_name_isnt(to()->web->welcome),
                                ])
                    >david<span class="text-primary font-semibold ">DESIGN</span></a>
                    <a aria-label="CV Page" href="/cv/"
                            @class([
                                'inline-flex items-center border-b-2 text-sm font-medium px-8 text-gray-600',
                                'border-primary' => route_name_is(to()->web->cv->name),
                                'border-transparent hover:border-gray-300 hover:text-gray-700' => route_name_isnt(to()->web->cv->name),
                                ])
                    >CV</a>
                </div>
            </div>
            <div class="ml-6 flex items-center">
                <a aria-label="Connect Page" href="{{to()->web->contact()}}" class="btn btn-xs">Connect</a>
            </div>
        </div>
    </div>
</nav>
