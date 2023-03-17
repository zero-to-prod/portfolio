<footer id="footer" class="mt-8 ml-0 nav-small:ml-narrow-nav nav-wide:ml-wide-nav" aria-labelledby="footer-heading">
    <h2 class="sr-only">Footer</h2>
    <div class="mx-auto max-w-7xl border-t p-4 2col:px-0 xl:grid xl:grid-cols-3 xl:gap-8">
        <x-a class="2col:block hidden" :href="to()->web->welcome()">
            <x-logo/>
        </x-a>
        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                    <h3>Membership</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{to()->web->login()}}">Login</a></li>
                        <li><a href="{{to()->web->newsletter()}}">Newsletter</a></li>
                    </ul>
                </div>
                <div class="mt-10 md:mt-0">
                    <h3>Support</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{to()->web->contact()}}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                    <h3>Pages</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{to()->web->welcome()}}" class="">Home</a></li>
                        <li><a href="{{to()->web->results()}}">Search</a></li>
                        <li><a href="{{to()->web->resultsPopular()}}">Popular</a></li>
                        <li><a href="{{to()->web->resultsTopics()}}">Topics</a></li>
                    </ul>
                </div>
                <div class="mt-10 md:mt-0">
                    <h3>Legal</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{to()->web->privacy()}}">Privacy Policy</a></li>
                        <li><a href="{{to()->web->tos()}}">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto 2col:mb-0 mb-16 max-w-7xl border-t border-gray-900/10 2col:p-0 p-4 py-8">
        <p class="text-xs leading-5 text-gray-500">&copy; {{date('Y')}} {{config('app.name')}}. All rights reserved.</p>
    </div>
</footer>