<x-main>
    @if(session()->has('email'))
        <div id="toast" aria-live="assertive" class="z-50 opacity-0 transition duration-500 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
            <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
                <div class=" pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">Message sent!</p>
                                <p class="mt-1 text-sm text-gray-500">You will be contacted via email at: {{session()->get('email')}}</p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button type="button" onclick="removeToast()" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const toast = document.getElementById('toast');

            document.addEventListener('DOMContentLoaded', () => {
                toast.classList.add('opacity-100');
            });

            function removeToast() {
                toast.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }
        </script>
    @endif
    <div class="isolate bg-gradient-to-b from-sky-200 to-white py-12">
        <div class="bg-white shadow rounded-lg px-6 lg:px-8 max-w-xl mx-auto py-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Let's Connect</h2>
        </div>
        <form action="{{route(Routes::connect->name)}}" method="post" class="mx-auto mt-16  sm:mt-20">
            @csrf
            <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email*</label>
                    <div class="mt-2.5">
                        <input type="email" name="email" id="email" autocomplete="email"
                               class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="subject" class="block text-sm font-semibold leading-6 text-gray-900">Subject</label>
                    <div class="mt-2.5">
                        <input type="text" name="subject" id="subject" autocomplete="organization"
                               class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="body" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                    <div class="mt-2.5">
                        <textarea name="body" id="body" rows="4"
                                  class="block w-full rounded-md border-0 py-2 px-3.5 text-sm leading-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600"></textarea>
                    </div>
                </div>
            </div>
            <div>
                <div class="mt-10">
                    <button type="submit" class="block w-full rounded-md bg-sky-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</x-main>

