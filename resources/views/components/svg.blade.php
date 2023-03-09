@props(['name'])
<img
     src="{{ Vite::asset('resources/images/'.$name.'.svg') }}"
     alt="{{$name}}"
        {{$attributes->merge(['class' => 'h-6 w-6'])}}
/>