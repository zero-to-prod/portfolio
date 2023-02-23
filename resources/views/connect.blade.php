<x-layouts.main>
    @if(session()->has('email'))
        <x-toast>
            <p>Message sent!</p>
            <p>You will be contacted via email at: {{session()->get('email')}}</p>
        </x-toast>
    @endif
    <div class="bg-gradient-to-b from-sky-200 to-white sm:py-6 sm:py-12">
        <div class="sm:bg-white sm:shadow sm:rounded-lg px-6 lg:px-8 max-w-xl mx-auto py-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Let's Connect</h2>
            </div>
            <form action="{{named_route(Routes::connect_store)}}" method="post" class="mx-auto mt-8">
                @csrf
                <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email*</label>
                        <div class="mt-2.5">
                            <input value="{{old('email')}}" type="email" name="email" id="email" autocomplete="email"
                                   class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600">
                        </div>
                        @if($errors->has('email'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="subject"
                               class="block text-sm font-semibold leading-6 text-gray-900">Subject*</label>
                        <div class="mt-2.5">
                            <input value="{{old('subject')}}" type="text" name="subject" id="subject"
                                   autocomplete="organization"
                                   class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600">
                        </div>
                        @if($errors->has('subject'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('subject') }}</p>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="body" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                        <div class="mt-2.5">
                            <textarea name="body" id="body" rows="4"
                                      class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600">{{old('body')}}</textarea>
                        </div>
                        @if($errors->has('body'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('body') }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="mt-10">
                        <button type="submit"
                                class="block w-full rounded-md bg-sky-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite('resources/js/top_nav_scroll.js')
</x-layouts.main>

