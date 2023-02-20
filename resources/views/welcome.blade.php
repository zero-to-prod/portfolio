<x-main>
    <div class="relative px-6 lg:px-8 bg-gradient-to-b from-sky-200 to-white">
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-6xl">Simple Things Are Hard</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Here, I showcase some of my work,
                    experience, and thoughts as I endeavor to simplify complexity in a way that provides value for
                    others.</p>
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
                    <h2 class="text-lg font-semibold text-sky-500">About Me</h2>
                    <h3 class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">Meet
                        david</h3>
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
                        <p class="text-lg text-gray-500">My name is David Smith and I'm a <span class="text-sky-500">Full Stack Web Developer</span>
                            based in Granger, Indiana.</p>
                    </div>
                    <div
                        class="prose prose-sky mx-auto mt-5 text-gray-500 lg:col-start-1 lg:row-start-1 lg:max-w-none">
                        <p>I help <span class="text-sky-500">small businesses</span> with their web and technology
                            needs.</p>
                        <p>I love tackling tough challenges and finding <span
                                class="text-sky-500">budget-friendly</span> fixes with my clients.</p>
                        <p>I mainly work with <span class="text-sky-500">web technologies</span>, but I also handle IT
                            and hardware support.</p>
                        <p>Here are some things I can do for you:</p>
                        <ul role="list">
                            <li>Spin up a <span class="text-sky-500">fresh new </span>website</li>
                            <li>Give your old site a <span class="text-sky-500">makeover</span></li>
                            <li>Make sure you can be found on <span class="text-sky-500">Google</span> and other search
                                engines
                            </li>
                            <li>Hook up <span class="text-sky-500">payments</span> and other services to your website
                            </li>
                            <li>Get your <span class="text-sky-500">email list</span> up and running and <span
                                    class="text-sky-500">make money</span> with it
                            </li>
                        </ul>

                        <p>
                            Here is a recent example of my work: <a href="https://interior-gardens.com/"
                                                                    target="_blank">Interior Gardens</a>.
                        </p>
                        <p>
                            I am currently accepting new clients and job opportunities. If you are interested in
                            connecting, please <a href="{{route(Routes::connect->name)}}">contact me</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/top_nav_scroll.js')
</x-main>
