<x-layouts.main>
    <x-header-section>
        <h1>Simple Things Are Hard</h1>
        <p>
            Here, I <em>showcase</em> some of my <em>work</em>, experience, and <em>thoughts</em> as I endeavor to
            <em>simplify complexity</em> in a way that provides <em>value</em> for others.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="#about-me" class="btn">About Me</a>
        </div>
    </x-header-section>

    <div id="about-me" class="overflow-hidden bg-white">
        <div class="relative mx-auto max-w-7xl py-16 px-4">
            <div class="mx-auto max-w-prose text-base lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-8">
                <div>
                    <h3 class="mt-2 text-3xl font-semibold leading-8 tracking-tight text-gray-900 sm:text-4xl">About
                        Me</h3>
                </div>
            </div>
            <div class="mt-8 lg:grid lg:grid-cols-2 lg:gap-8">
                <div class="relative lg:col-start-2 lg:row-start-1">
                    <div class="relative mx-auto max-w-prose text-base lg:max-w-none">
                        <figure>
                            <div class="aspect-w-1 aspect-h-1">
                                <img class="rounded-lg object-cover object-top shadow-lg"
                                     src="{{ Vite::asset('resources/images/portrait.jpg') }}"
                                     alt="Portrait" width="1184"
                                     height="1376">
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="mt-8 lg:mt-0">
                    <div class="mx-auto max-w-prose text-base lg:max-w-none">
                        <p class="text-lg text-gray-500">I'm David Smith, a <em>Full Stack Web Developer</em>
                            based in Granger, Indiana.</p>
                    </div>
                    <div
                        class="prose prose-sky mx-auto mt-5 text-gray-500 lg:col-start-1 lg:row-start-1 lg:max-w-none">
                        <p>
                            I help <em>small businesses</em> with their <em>web and technology</em> needs.
                        </p>
                        <p>
                            I love tackling <em>tough challenges</em> and finding <em>budget-friendly</em> fixes with my
                            clients.
                        </p>
                        <p>
                            I mainly work with <em>web technologies</em>, but I also handle
                            <em>IT and hardware support</em>.
                        </p>
                        <p>Here are some things I can do for you:</p>
                        <ul role="list">
                            <li>Spin up a <em>fresh</em> new website</li>
                            <li>Give your old site a <em>makeover</em></li>
                            <li>Make sure your business is <em>found on Google</em> and other search engines</li>
                            <li>Hook up <em>payments</em> and other services to your website</li>
                            <li>Get your <em>email list</em> up and running and <em>make money</em> with it</li>
                        </ul>
                        <p>
                            Here is a recent example of my work:
                            <a class="text-blue-700" href="https://interior-gardens.com/">Interior Gardens</a>.
                        </p>
                        <p>
                            I am currently <em>accepting</em> new clients and job opportunities. If you are interested
                            in connecting, please get in <a class="text-blue-700" href="{{named_route(Routes::connect)}}">touch with me.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/top_nav_scroll.js')
</x-layouts.main>
