<x-main :title="'CV' . ' | ' . config('app.name')">
    <x-header-section>
        <h1 role="heading">CV and Work History</h1>
        <p aria-label="Subtitle" role="doc-subtitle">
            On this page, I'm excited to share my <em>professional journey</em> and the
            <em>various businesses</em> I've enjoyed owning. You'll find more information about each event in the
            <em>timeline</em>, so feel free to <em>explore</em> and learn more about my experiences.
        </p>
    </x-header-section>

        <nav aria-label="Work History Section" class="mx-auto max-w-7xl p-4">
        <x-history-list>
            {{-- Senior Full Stack Developer --}}
            <x-history-item>
                <x-slot name="image">
                    <img src="{{ Vite::asset('resources/images/viewrail.jpg') }}" alt="viewrail logo"/>
                </x-slot>
                <x-slot name="title">Senior Full Stack Developer</x-slot>
                <x-slot name="company">Viewrail Full-time</x-slot>
                <x-slot name="dates">Jan 2022 - Feb 2023 · 1 yr 2 mos</x-slot>
                <x-history-details>
                    <h2>Professional Growth at Viewrail</h2>
                    <p class="subtitle">
                        Building a New Development Process for Improved Flexibility and Confidence
                    </p>
                    <p> I greatly <em>enjoyed</em> working at Viewrail as a developer for ten months before
                        being <em>promoted</em> to a <em>senior</em> position.
                    </p>
                    <p> The company <em>entrusted</em> me to <em>lead</em> the development of their
                        production <em>ERP</em> system, demonstrating their <em>confidence</em> in my
                        abilities.
                    </p>
                    <p>
                        The development of this system presented a unique <em>opportunity</em>. Our
                        development style needed <em>structure</em> as the project was still young. With the
                        team's <em>support</em>, we started building a process to enhance our
                        <em>confidence</em> in deployment while optimizing for <em>responsiveness</em> and
                        <em>flexibility</em>.
                    </p>
                    <h2>Team Building</h2>
                    <p class="subtitle">
                        Improving our Development Process and Work Culture
                    </p>

                    <p> With the team's help, we <em>proactively</em> identified areas of
                        <em>vulnerability</em> and <em>weakness</em> and <em>worked together</em> to enhance
                        our workflow. Our <em>efforts</em> resulted in a significant <em>improvement</em> in
                        our development process and work <em>culture</em>.
                    </p>
                    <p>Some of the improvements were:</p>
                    <ul role="list">
                        <li> Developing a <em>robust</em> deployment process that
                            included the use of a staging site in the deployment pipeline
                        </li>
                        <li>Adding <em>automated tests</em> that protected <em>mission-critical</em>
                            processes
                        </li>
                        <li>
                            Building a <em>code review</em> process from scratch
                        </li>
                        <li>
                            Developing the idea of <em>Total Ownership</em> that positively impacted the
                            team <em>culture</em>.
                        </li>
                        <li>
                            Successfully <em>updated software dependencies</em>
                            that were up to <em>two major versions</em> behind.
                        </li>
                    </ul>

                    <h2>Improved Productivity and Confidence</h2>
                    <p class="subtitle">
                        Tool Building: Real-time Monitoring and Dashboards for Mission-critical Diagnostics
                    </p>
                    <p> With all of the remarkable changes we made, our <em>productivity</em> improved
                        significantly. We were able to implement features more <em>quickly</em> and update
                        our dependencies more <em>frequently</em>.
                    </p>
                    <p>
                        Ultimately our efforts gave us reliable <em>confidence</em> when we
                        <em>deployed</em> changes into production.
                    </p>
                    <p>Some of the diagnostic tools that added to this confidence were:</p>
                    <ul role="list">
                        <li><em>Real-time</em> monitoring of exceptions and logs</li>
                        <li>An innovative UI that monitored the <em>job queue</em></li>
                        <li>A concise page that provided <em>comprehensive</em> audits</li>
                        <li>A <em>unique</em> tree-based explorer for our models and their relationships
                        </li>
                        <li>A dashboard that showed <em>mission-critical</em> diagnostic data</li>
                    </ul>
                    <h2>Personal Development</h2>
                    <h3>A Lesson in Empathy</h3>
                    <p class="subtitle">
                        How Human Relationships Build Better Solutions
                    </p>
                    <p> I had the <em>privilege</em> of working with the <em>fantastic</em> people at
                        Viewrail, who taught me an invaluable <em>lesson</em> about the importance of <em>deeply</em>
                        understanding a problem and <em>empathizing</em> with those it affects.
                    </p>
                    <p> Understanding the bigger picture was <em>critical</em> in my <em>collaborations</em>
                        with various teams. Often, a problem seemed <em>isolated</em> to one group, but as I
                        <em>worked</em> with stakeholders, I <em>discovered</em> it also impacted other
                        areas. In such cases, <em>empathy</em> proved to be a powerful tool to
                        <em>unite</em> everyone and be a part of the <em>solution</em>.
                    </p>
                    <p>I learned to:</p>
                    <blockquote>
                        Understand a problem in a deep and empathic way before implementing a solution.
                    </blockquote>
                    <h3>Human Relationships</h3>
                    <p class="subtitle">
                        Software: Much More than Code
                    </p>
                    <p> I had the <em>privilege</em> of working with the <em>fantastic</em> people at
                        Viewrail, who taught me an <em>invaluable</em> lesson about the importance of <em>deeply</em>
                        understanding a problem and <em>empathizing</em> with those it affects.
                    </p>
                    <p>
                        To <em>understand</em> a problem, I needed to <em>broaden</em> my understanding
                        and <em>perspective</em>. Doing so made me better <em>equipped</em> to collaborate
                        with <em>diverse</em> teams and stakeholders. Often, what may have <em>initially</em>
                        seemed like a problem affecting only one <em>group</em>, turned out to have <em>broader</em>
                        implications across multiple areas. Through my <em>experiences</em>, I've learned to
                        truly take the time to <em>understand</em> the full <em>scope</em> of a situation.
                    </p>
                    <p>
                        <em>Empathy</em> is crucial to building and maintaining <em>dependable</em>
                        relationships. When you experience a user's <em>struggles</em> with them, it creates
                        a <em>powerful</em> collaboration that can <em>leverage</em> their valuable <em>insights</em>.
                        This <em>collaboration</em> is <em>priceless</em> and helps <em>uncover</em> the
                        technical <em>realities</em> essential to <em>providing</em> a helpful
                        <em>solution</em>.
                    </p>
                    <p>
                        <em>Software</em> is more than
                        <em>code</em>; it is about
                        <em>people</em> and how they work together to solve
                        <em>problems</em>.
                    </p>
                    <figure>
                        <blockquote>
                            Software Development is an exercise in human relationships.
                        </blockquote>
                        <figcaption>Kent Beck <cite>
                                <a href="https://medium.com/@kentbeck_7670/software-design-is-human-relationships-part-1-of-3-perspective-1bcd53855557">
                                    Software Design is Human Relationships: Part 1 of 3, Perspective</a>
                            </cite>
                        </figcaption>
                    </figure>
                    <h2>Responsibilities: </h2>
                    <p class="subtitle">
                        Primary Responsibilities While at Viewrail
                    </p>
                    <ul role="list">
                        <li> Led the <em>architecting</em> and implementation of the company's
                            <em>legacy</em> ERP system into a <em>modern</em> technology stack
                        </li>
                        <li> Worked with the many <em>teams</em> and stakeholders of the company to
                            <em>move</em> features into the <em>new</em> system
                        </li>
                        <li>
                            Implemented <em>automated</em> testing and improved the <em>deployment</em>
                            pipeline
                        </li>
                        <li>
                            <em>Simplified</em> the database through schema changes and <em>data</em>
                            migrations
                        </li>
                        <li> Was the primary person <em>responsible</em> for keeping the systems
                            <em>running</em> and <em>available</em>
                        </li>
                        <li>
                            Was <em>responsible</em> for code reviews, training, <em>collaboration</em>, etc
                        </li>
                    </ul>
                </x-history-details>
            </x-history-item>

            {{-- Full Stack Developer --}}
            <x-history-item>
                <x-slot name="image">
                    <img src="{{ Vite::asset('resources/images/viewrail.jpg') }}" alt="viewrail logo"/>
                </x-slot>
                <x-slot name="title">Full Stack Developer</x-slot>
                <x-slot name="company">Viewrail Full-time</x-slot>
                <x-slot name="dates">Apr 2021 - Jan 2022 · 10 mos</x-slot>
                <x-history-details>
                    <h2>Previous Experience</h2>
                    <p>
                        Following my experience at <em>RealClearPolitics</em>, I arrived at Viewrail
                        with <em>valuable</em> backend knowledge. I was well-acquainted with the project and its goal
                        of <em>transferring</em> features from a legacy <em>ColdFusion</em> project to a <em>modern</em>
                        tech stack.
                    </p>
                    <h2>Personal Development</h2>
                    <p>
                        Viewrail's Technology stack <em>impressed</em> me with its <em>advanced</em>
                        features, including:
                    </p>
                    <ul role="list">
                        <li>GraphQL</li>
                        <li>React</li>
                        <li>TypeScript</li>
                    </ul>
                    <p>
                        I was <em>thrilled</em> to have the opportunity to work with these <em>new</em>
                        technologies, and I had the pleasure of being <em>mentored</em> by an <em>exceptional</em>
                        individual who helped me expand my <em>knowledge</em> of web development.
                    </p>
                    <p>
                        Thanks to this <em>experience</em>, I now understand the importance of
                        <em>type safety</em> and how <em>functional</em> programming can effectively manage
                        <em>state</em>.
                    </p>
                    <h2>Responsibilities</h2>
                    <ul role="list">
                        <li>Front end features</li>
                        <li>Front end pages</li>
                        <li>Back end functionality</li>
                        <li>Data migrations</li>
                        <li>API Integrations between web stores, sales tools, and operations database</li>
                        <li>Other job-related duties as assigned</li>
                    </ul>
                </x-history-details>
            </x-history-item>

            {{-- List of Technologies --}}
            <x-history-item>
                <x-slot name="image">
                    <img src="{{ Vite::asset('resources/images/viewrail.jpg') }}" alt="viewrail logo"/>
                </x-slot>
                <x-slot name="title">Technologies I used while at Viewrail</x-slot>
                <x-slot name="company">Docker, React/TS, Laravel, Graphql</x-slot>
                <x-slot name="dates">Apr 2021 - Feb 2023 · ~2 years</x-slot>
                <x-history-details>
                    <p> An incomplete list of Technologies I used while at Viewrail</p>
                    <h2> Frontend: </h2>
                    <ul role="list">
                        <li><a href="https://reactjs.org/">React (functional components)</a></li>
                        <li><a href="https://www.typescriptlang.org/">TypeScript</a></li>
                        <li><a href="https://material-ui.com/">MATERIAL-UI</a></li>
                        <li><a href="https://formik.org/">Formik</a></li>
                        <li><a
                                href="https://graphql.org/">GraphQL</a></li>
                        <li><a href="https://www.apollographql.com/">Apollo-GraphQL</a></li>
                        <li><a href="https://www.graphql-code-generator.com/">GraphQL-Codegen</a></li>
                        <li><a href="https://create-react-app.dev/">create-react-app</a></li>
                        <li><a href="https://recharts.org/">Recharts</a></li>
                        <li><a href="https://momentjs.com/">Moment.js</a></li>
                        <li><a href="https://prettier.io/">Prettier</a></li>
                        <li><a href="https://nodejs.org/">NodeJs</a></li>
                        <li><a href="https://babeljs.io/">BABEL</a></li>
                        <li><a href="https://www.npmjs.com/">npm</a></li>
                        <li><a href="https://www.json.org/json-en.html">JSON</a></li>
                        <li><a href="https://github.com/remix-run/react-router">react-router</a></li>
                        <li><a href="https://github.com/jquense/yup/tree/pre-v1">yup</a></li>
                        <li><a href="https://github.com/react-dropzone/react-dropzone/">react-dropzone</a>
                        </li>
                    </ul>
                    <h3> Backend: </h3>
                    <ul role="list">
                        <li><a href="https://www.php.net/">PHP 8.1</a></li>
                        <li><a href="https://www.nginx.com/">NGINX</a></li>
                        <li><a
                                href="https://laravel.com">Laravel</a></li>
                        <li><a href="https://laravel.com/docs/master/passport">Passport</a></li>
                        <li><a href="https://lighthouse-php.com/">Lighthouse</a></li>
                        <li><a href="https://phpunit.de/">PHP Unit</a></li>
                        <li><a href="https://carbon.nesbot.com/">Carbon</a></li>
                        <li><a href="https://github.com/HubSpot/hubspot-api-php">hubspot/api-client</a></li>
                        <li><a href="https://github.com/sendgrid/sendgrid-php">sendgrid/sendgrid</a></li>
                        <li><a href="https://github.com/yidas/google-maps-services-php">yidas/google-maps-services</a>
                        </li>
                        <li><a href="https://github.com/aws/aws-sdk-php-laravel">aws/aws-sdk-php-laravel</a>
                        </li>
                        <li><a href="https://github.com/chelout/laravel-relationship-events">chelout/laravel-relationship-events</a>
                        </li>
                        <li><a href="https://github.com/doctrine/dbal">doctrine/dbal</a></li>
                        <li><a href="https://github.com/guzzle/guzzle">guzzlehttp/guzzle</a></li>
                        <li>
                            <a href="https://packagist.org/packages/owen-it/laravel-auditing">owen-it/laravel-auditing</a>
                        </li>
                        <li><a href="https://github.com/barryvdh/laravel-ide-helper">barryvdh/laravel-ide-helper</a>
                        </li>
                    </ul>
                    <h3> Source Control: </h3>
                    <ul role="list">
                        <li><a href="https://git-scm.com/">git</a></li>
                    </ul>
                    <h3> Authentication: </h3>
                    <ul role="list">
                        <li><a href="https://oauth.net/2/">Oauth2.0</a></li>
                    </ul>
                    <h3> PaaS: </h3>
                    <ul role="list">
                        <li><a href="https://www.docker.com/">Docker</a></li>
                    </ul>
                    <h3> Cloud Hosting </h3>
                    <ul role="list">
                        <li><a href="https://www.linode.com/">Linode</a></li>
                    </ul>
                    <h3> Databases </h3>
                    <ul role="list">
                        <li><a href="https://mariadb.com/">MariaDB</a></li>
                    </ul>
                    <h3> Development Tools </h3>
                    <ul role="list">
                        <li><a href="https://www.jetbrains.com/phpstorm/">PhpStorm</a></li>
                        <li><a href="https://xdebug.org/">Xdebug</a></li>
                    </ul>
                    <h3> Operating Systems </h3>
                    <ul role="list">
                        <li>Linux</li>
                        <li>Windows/WSL</li>
                    </ul>
                </x-history-details>
            </x-history-item>

            {{-- RealClearPolitics --}}
            <x-history-item>
                <x-slot name="image">
                    <img src="{{ Vite::asset('resources/images/rcp.jpg') }}" alt="real clear politics logo"/>
                </x-slot>
                <x-slot name="title">Full Stack Developer</x-slot>
                <x-slot name="company">RealClearPolitics Full-time</x-slot>
                <x-slot name="dates">Aug 2019 - Apr 2021 · 1 yr 9 mos</x-slot>
            </x-history-item>

            {{-- ZeroToProd --}}
            <x-history-item>
                <x-slot name="title">Full Stack Developer / Owner</x-slot>
                <x-slot name="company">ZeroToProd (Software Development Company)</x-slot>
                <x-slot name="dates">Apr 2019 - Ongoing</x-slot>
            </x-history-item>

            {{-- Edge My Neighborhood --}}
            <x-history-item>
                <x-slot name="image">
                    <img src="{{ Vite::asset('resources/images/emn.jpg') }}" alt="edge my neighborhood logo"/>
                </x-slot>
                <x-slot name="title">Full Stack Developer / Owner</x-slot>
                <x-slot name="company">EdgeMyNeighborhood Part Time</x-slot>
                <x-slot name="dates">Jan 2017 - Apr 2019 · 2 yr 3 mos</x-slot>
            </x-history-item>

            {{-- Innovation Machining --}}
            <x-history-item :hideTimeline="true">
                <x-slot name="title">Design Engineer / Machinist</x-slot>
                <x-slot name="company">Innovation Machining Full Time</x-slot>
                <x-slot name="dates">Apr 2003 - August 2019 · 13 yr 4 mos</x-slot>
            </x-history-item>
        </x-history-list>
    </nav>
    @vite('resources/js/top_nav_scroll.js')
</x-main>
