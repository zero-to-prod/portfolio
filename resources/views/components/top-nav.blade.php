<nav id="nav"
    @class([
   'sticky top-0 z-50',
   'bg-sky-200 transition-all duration-500 hover:bg-white hover:shadow' => route_name_is(Routes::welcome),
   'bg-white shadow' => route_name_isnt(Routes::welcome),
   ])
>
    <div class="mx-auto max-w-7xl px-4">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex space-x-8">
                    <a href="{{Routes::welcome->value}}"
                        @class([
                            'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::welcome),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => route_name_isnt(Routes::welcome),
                            ])
                    >davidDESIGN</a>
                    <a href="{{Routes::cv->value}}"
                        @class([
                            'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium',
                            'border-sky-500 text-gray-900' => route_name_is(Routes::cv),
                            'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => route_name_isnt(Routes::cv),
                            ])
                    >CV</a>
                </div>
            </div>
            <div class="ml-6 flex items-center">
                <a href="{{route(Routes::connect->name)}}"
                   class="inline-flex items-center rounded-md border border-transparent bg-sky-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                    Connect
                </a>
            </div>
        </div>
    </div>
</nav>
