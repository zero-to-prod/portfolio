<li class="relative pb-10">
    @if($hideTimeline ?? false)
    @else
        <div class="absolute top-12 left-12 -ml-px h-full bg-sky-600 mt-0.5 w-0.5" aria-hidden="true"></div>
    @endif

    <div class="relative flex items-start group">
        <div class="m-2 flex items-center shadow-lg">
            <div class="relative z-10 flex h-20 w-20 items-center justify-center">
                @isset($image)
                    {{ $image }}
                @else
                    <img src="{{ Vite::asset('resources/images/generic-logo.jpg') }}" alt="generic logo"/>
                @endif
            </div>
        </div>
        <div class="mt-3 ml-4 flex min-w-0 flex-col">
            <span aria-label="Title" class="font-medium">{{ $title }}</span>
            <span aria-label="Company" class="text-gray-800">{{ $company }}</span>
            <span aria-label="Dates" class="text-gray-500">{{ $dates }}</span>
            {{ $slot }}
        </div>
    </div>
</li>
