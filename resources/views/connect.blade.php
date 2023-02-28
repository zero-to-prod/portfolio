<?php

use App\Http\Routes;

?>
<x-main :title="'Connect'">
    @if(session()->has('email'))
        <x-toast>
            <p>Message sent!</p>
            <p>You will be contacted via email at: {{session()->get('email')}}</p>
        </x-toast>
    @endif
    <div class="bg-gradient-to-b from-sky-200 to-white sm:py-6 sm:py-12">
        <div class="sm:bg-white sm:shadow sm:rounded-lg px-6 lg:px-8 max-w-xl mx-auto py-8">
            <div class="mx-auto max-w-2xl text-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Let's Connect</h1>
            </div>
            <form action="{{route_as(Routes::connect_store)}}" method="post" class="mx-auto mt-8 space-y-8">
                @csrf
                <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                    <x-form-control>
                        <label for="email">Email*</label>
                        <input value="{{old('email')}}" type="email" name="email" id="email" autocomplete="email">
                        @if($errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                        @endif
                    </x-form-control>
                    <x-form-control>
                        <label for="subject">Subject*</label>
                        <input value="{{old('subject')}}" type="text" name="subject" id="subject"
                               autocomplete="organization">
                        @if($errors->has('subject'))
                            <p>{{ $errors->first('subject') }}</p>
                        @endif
                    </x-form-control>
                    <x-form-control>
                        <label for="body">Message</label>
                        <textarea name="body" id="body" rows="4">{{old('body')}}</textarea>
                        @if($errors->has('body'))
                            <p>{{ $errors->first('body') }}</p>
                        @endif
                    </x-form-control>
                </div>
                <button type="submit" class="btn btn-wide"> Submit</button>
            </form>
        </div>
    </div>
    @vite('resources/js/top_nav_scroll.js')
</x-main>

