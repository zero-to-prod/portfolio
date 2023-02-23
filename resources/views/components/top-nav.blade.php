<nav id="nav" class="sticky top-0 z-50 bg-sky-200 transition-all duration-500 hover:bg-white hover:shadow">
    <div class="mx-auto max-w-7xl px-4">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex">
                    <a href="{{named_route(Routes::welcome)}}"
                        @class([
                            'inline-flex items-center border-b-2 sm:text-lg',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::welcome),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => route_name_isnt(Routes::welcome),
                            ])
                    >david<span class="text-sky-500">DESIGN</span></a>
                    <a href="{{named_route(Routes::cv)}}"
                        @class([
                            'inline-flex items-center border-b-2 text-sm font-medium px-8',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::cv),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => route_name_isnt(Routes::cv),
                            ])
                    >CV</a>
                </div>
            </div>
            <div class="ml-6 flex items-center">
                <a href="{{named_route(Routes::connect)}}" class="btn btn-xs">Connect</a>
            </div>
        </div>
    </div>
</nav>
