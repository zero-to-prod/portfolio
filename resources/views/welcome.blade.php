<x-main>
    <div class="bg-gradient-to-b from-sky-200 to-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 sm:text-6xl">Simple Things Are Hard</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Here, I <span class="font-semibold">showcase</span> some of
                    my <span class="font-semibold">work</span>, experience, and <span class="font-semibold">thoughts</span>
                    as I endeavor to <span class="font-semibold">simplify complexity</span> in a way that provides
                    <span class="font-semibold">value</span> for others.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#about-me"
                       class="rounded-md bg-sky-600 px-3.5 py-1.5 text-base font-semibold leading-7 text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">About
                        Me</a>
                </div>
            </div>
        </div>
    </div>
    <div id="about-me" class="overflow-hidden bg-white">
        <div class="relative mx-auto max-w-7xl py-16 px-4">
            <div class="mx-auto max-w-prose text-base lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-8">
                <div>
                    <h3 class="mt-2 text-3xl font-semibold leading-8 tracking-tight text-gray-900 sm:text-4xl">About Me</h3>
                </div>
            </div>
            <div class="mt-8 lg:grid lg:grid-cols-2 lg:gap-8">
                <div class="relative lg:col-start-2 lg:row-start-1">
                    <div class="relative mx-auto max-w-prose text-base lg:max-w-none">
                        <figure>
                            <div class="aspect-w-12 aspect-h-7 lg:aspect-none">
                                <img class="rounded-lg object-cover object-center shadow-lg"
                                     src=""
                                     alt="Portrait" width="1184"
                                     height="1376">
                            </div>
                            <figcaption class="mt-3 flex text-sm text-gray-500">
                                <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-2">Photograph by April Smith</span>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="mt-8 lg:mt-0">
                    <div class="mx-auto max-w-prose text-base lg:max-w-none">
                        <p class="text-lg text-gray-500">I'm David Smith, a <span class="font-semibold">Full Stack Web Developer</span>
                            based in Granger, Indiana.</p>
                    </div>
                    <div
                        class="prose prose-sky mx-auto mt-5 text-gray-500 lg:col-start-1 lg:row-start-1 lg:max-w-none">
                        <p>
                            I help <span class="font-semibold">small businesses</span> with their <span class="font-semibold">web and technology</span>
                            needs.
                        </p>
                        <p>I love tackling <span class="font-semibold">tough challenges</span> and finding <span
                                class="font-semibold">budget-friendly</span> fixes with my clients.</p>
                        <p>I mainly work with <span class="font-semibold">web technologies</span>, but I also handle
                            <span class="font-semibold">IT and hardware support</span>.</p>
                        <p>Here are some things I can do for you:</p>
                        <ul role="list">
                            <li>Spin up a <span class="font-semibold">fresh new </span>website</li>
                            <li>Give your old site a <span class="font-semibold">makeover</span></li>
                            <li>Make sure your business is <span class="font-semibold">found on Google</span> and other
                                search
                                engines
                            </li>
                            <li>Hook up <span class="font-semibold">payments</span> and other services to your website
                            </li>
                            <li>Get your <span class="font-semibold">email list</span> up and running and <span
                                    class="font-semibold">make money</span> with it
                            </li>
                        </ul>
                        <p>
                            Here is a recent example of my work:
                            <a href="https://interior-gardens.com/">Interior Gardens</a>.
                        </p>
                        <p>
                            I am currently accepting new clients and job opportunities. If you are interested in
                            connecting, please get in <a href="{{named_route(Routes::connect)}}">touch with me.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/top_nav_scroll.js')
</x-main>
