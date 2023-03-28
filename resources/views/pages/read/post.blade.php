<?php

use App\Helpers\PostTypes;
use App\Http\Controllers\Api\ThanksResponse;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Spatie\SchemaOrg\Schema;

/* @var Post $post */
/* @var File $feature */
/* @var Collection<Tag, Tag> $tags */
$amount = ThanksResponse::amount;
$email = ThanksResponse::email;
$card_number = ThanksResponse::card_number;
$expiration = ThanksResponse::expiration;
$cvc = ThanksResponse::cvc;
?>

<x-main :title="$post->title . ' | ' . config('app.name')" :description="$post->subtitle">
    @push('data')
        <?php
        $author = Schema::person()->name($post->author()->name)->url(to()->resultsAuthor($post->author()));
        $publisher = Schema::organization()
            ->name(config('app.name'))
            ->email(config('mail.from.address'))
            ->url(to()->welcome())
            ->brand(Schema::brand()
                ->name(config('app.name'))
                ->logo(to()->file($post->file, 837, 0))
                ->url(to()->welcome())
            )
        ->founder(Schema::person()->name('David Smith'));
        $localBusiness = Schema::article()
            ->url(to()->read($post))
            ->about($post->subtitle)
            ->wordCount($post->public_word_count)
            ->description($post->subtitle)
            ->inLanguage('en-US')
            ->isAccessibleForFree(true)
            ->isFamilyFriendly(true)
            ->articleBody($post->public_content)
            ->text($post->public_content)
            ->abstract($post->subtitle)
            ->countryOfOrigin('US')
            ->thumbnailUrl(to()->file($post->file, 100, 0))
            ->dateCreated($post->created_at)
            ->headline($post->title)
            ->name($post->title)
            ->publisher($publisher)
            ->image(to()->file($post->file, 837, 0))
            ->datePublished($post->original_publish_date)
            ->dateModified($post->updated_at)
            ->author([$author]);
        echo $localBusiness->toScript();
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name($post->title)->url(to()->read($post))),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="mx-auto block 3col:flex max-w-7xl 3col:flex-row justify-center">
        <div class="shrink max-w-post-2col">
            <div class="relative 2col:mx-2">
                <x-img class="h-full w-full object-cover object-center"
                       :file="$post->file"
                       :width="837"
                       :title="''"
                />
                @if($post->premiere_at !== null && $post->premiere_at?->gt(now()))
                    <x-premiere-chip :post="$post"/>
                @endif
                <x-reading-time-chip :post="$post" :text="' min read'"/>
            </div>
            <article class="2col:px-2 px-4 space-y-4 2col:space-y-6" aria-label="Body" itemscope
                     itemtype="{{to()->read($post)}}">
                <div class="2col:block hidden space-y-2">
                    <div class="flex justify-between pt-2">
                        <div class="font-bold">
                            <h1 id="title" class="text-2xl" itemprop="headline">{{$post->title}}</h1>
                            <p id="subtitle" class="text-sm">{{$post->subtitle}}</p>
                        </div>
                        <div class="text-right text-sm">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="mt-2 flex w-full flex-wrap justify-between gap-2" itemprop="author" itemscope
                         itemtype="https://schema.org/Person">
                        <x-a class="mr-4 flex gap-2" title="Authors Page"
                             :href="to()->resultsAuthor($post->author())">
                            <x-img class="my-auto h-10 w-10 rounded-full" title="Authors Page" itemprop="url"
                                   :file="$post->author()->file" :height="80"/>
                            <div class="flex flex-col">
                                <p itemprop="name">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authorPostCount()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <div class="flex gap-2">
                            <x-a title="Subscribe to Newsletter" :href="to()->newsletter()"
                                 class="my-auto flex gap-2 rounded-lg bg-gray-800 px-3 py-2 shadow-md hover:bg-gray-700">
                                <x-svg :name="'mail-dark'" class="!h-6 !w-6"/>
                                <span class="my-auto text-sm font-bold text-white">Newsletter</span>
                            </x-a>
                            <livewire:reactions :post="$post"/>
                            <button id="share" type="button" title="Share this content."
                                    class="my-auto flex gap-2 rounded-lg bg-gray-200 p-2 hover:bg-gray-300">
                                <x-svg :name="'share'" class="!h-6 !w-6"/>
                                <span class="my-auto text-sm font-bold">Share</span>
                            </button>
                            <button id="thanks" type="button"
                                    title="Buy a Thanks, which directly supports content like this."
                                    class="my-auto flex gap-2 rounded-lg bg-gray-200 p-2 hover:bg-gray-300">
                                <x-svg :name="'thanks'" class="!h-6 !w-6"/>
                                <span class="my-auto text-sm font-bold">Thanks</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="2col:hidden space-y-2">
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-bold">{{$post->title}}</h1>
                        <p class="text-sm">{{$post->subtitle}}</p>
                    </div>
                    <div class="flex justify-between">
                        <x-a class="mr-4 flex gap-2 text-base font-semibold" :href="'#'">
                            <x-img class="my-auto h-10 w-10 rounded-full" :file="$post->author()->file" :height="80"/>
                            <div>
                                <p class="underline">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authorPostCount()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <x-a title="Subscribe to Newsletter" :href="to()->newsletter()"
                             class="my-auto flex gap-2 rounded-lg bg-gray-800 px-3 py-2 shadow-md hover:bg-gray-700">
                            <x-svg :name="'mail-dark'" class="!h-6 !w-6"/>
                            <span class="my-auto text-sm font-bold text-white">Newsletter</span>
                        </x-a>
                    </div>
                    <div class="flex justify-between gap-2">
                        <livewire:reactions :post="$post"/>
                        <button id="thanks-mobile" type="button"
                                title="Buy a Thanks, which directly supports content like this."
                                class="my-auto flex gap-2 rounded-lg bg-gray-200 p-2 hover:bg-gray-300">
                            <x-svg :name="'thanks'" class="!h-6 !w-6"/>
                            <span class="my-auto text-sm font-bold">Thanks</span>
                        </button>
                        <button id="share-mobile" type="button"
                                class="my-auto flex gap-2 rounded-lg bg-gray-200 p-2 hover:bg-gray-300">
                            <x-svg :name="'share'" class="!h-6 !w-6"/>
                            <span class="my-auto text-sm font-bold">Share</span>
                        </button>
                    </div>
                    <div class="text-sm">
                        <x-published-date :post="$post"/>
                        <x-views :post="$post"/>
                    </div>
                </div>
                <div id="form-wrapper" class="my-4 hidden border-t border-b py-4">
                    <div class="mx-auto rounded-lg p-4 shadow bg-base-200 max-w-[380px]">
                        <h3 class="text-xl font-bold">Say Thanks</h3>
                        <p class="text-sm font-bold">Buy a Thanks, and directly support content like this.</p>
                        <form id="thanks-form" class="mt-4 space-y-4">
                            <div class="flex flex-wrap justify-center gap-2">
                                @foreach([1, 2, 5, 10] as $amount)
                                    <label class="flex cursor-pointer items-center rounded-lg bg-gray-300 p-2 hover:bg-base-300">
                                        <input type="radio" id={{$amount}}1" name="amount"
                                               value="{{$amount}}" {{$amount === 2 ? 'checked' : null}}>
                                        <x-svg :name="'thanks-white'"/>
                                        <span class="pl-2 font-bold">${{$amount}}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div>
                                <label class="text-sm font-bold" for="{{$email}}">Email</label>
                                <input class="text-lg input"
                                       id="{{$email}}"
                                       type="{{$email}}"
                                       name="{{$email}}"
                                       value="{{old($email)}}"
                                       placeholder="Your email address"
                                       required
                                />
                                <p id="email-errors" class="text-sm font-bold text-error"></p>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Card Information</p>
                                <label for="{{$card_number}}" class="sr-only">Card number</label>
                                <input class="rounded-br-none rounded-bl-none text-lg input tracking-[.2rem]"
                                       autocomplete="cc-number"
                                       autocorrect="off"
                                       spellcheck="false"
                                       id="{{$card_number}}"
                                       name="{{$card_number}}"
                                       type="text"
                                       inputmode="numeric"
                                       aria-label="Card number"
                                       placeholder="1234 1234 1234 1234"
                                       aria-invalid="false"
                                       value=""
                                       minlength="13"
                                       maxlength="19"
                                       required
                                >
                                <div class="flex">
                                    <label for="{{$expiration}}" class="sr-only">Expiration Month</label>
                                    <input class="rounded-none rounded-bl text-lg input -mt-[1px] -mr-[.5px]"
                                           autocomplete="cc-exp"
                                           autocorrect="off"
                                           spellcheck="false"
                                           id="{{$expiration}}"
                                           name="{{$expiration}}"
                                           type="text"
                                           inputmode="numeric"
                                           aria-label="Expiration"
                                           placeholder="MM / YY"
                                           aria-invalid="false"
                                           value=""
                                           maxlength="7"
                                           minlength="7"
                                           required
                                    >
                                    <label for="{{$cvc}}" class="sr-only">CVC</label>
                                    <input class="rounded-none rounded-br text-lg input -mt-[1px] -ml-[.5px]"
                                           autocomplete="cc-csc"
                                           autocorrect="off"
                                           spellcheck="false"
                                           id="{{$cvc}}"
                                           name="{{$cvc}}"
                                           type="text"
                                           inputmode="numeric"
                                           aria-label="CVC"
                                           placeholder="CVC"
                                           aria-invalid="false"
                                           value=""
                                           minlength="3"
                                           maxlength="4"
                                           required
                                    >
                                </div>
                                <div class="text-sm font-bold text-error">
                                    <p id="expiration-error"></p>
                                    <p id="card-errors"></p>
                                    <p id="cvc-errors"></p>
                                    <p id="expiration-errors"></p>
                                    <p id="message-errors"></p>
                                </div>
                            </div>
                            <button id="submit" class="font-bold btn btn-wide">Buy and Send</button>
                            <div id="message-success" class="hidden text-sm font-bold">
                                <p class="flex gap-1">
                                    <x-svg :name="'check-green'"/>
                                    <span class="my-auto">Thank you for supporting! A receipt will be sent to your email</span>
                                </p>
                            </div>
                        </form>
                        <script>
                            const expirationInput = document.getElementById('expiration');
                            const expirationError = document.getElementById('expiration-error');

                            function getCvcInput() {
                                // Remove any non-numeric characters
                                let input = expirationInput.value.replace(/\D/g, '');

                                // Add a slash between the month and year if the input length is greater than 2
                                if (input.length > 2) {
                                    input = input.slice(0, 2) + ' / ' + input.slice(2);
                                }

                                // Set the value of the input to the formatted value
                                expirationInput.value = input;

                                return input;
                            }

                            expirationInput.addEventListener('input', () => {
                                const input = getCvcInput();

                                // Validate the input if the year is entered
                                if (input.length === 7) {
                                    if (validateExpiration(...input.split(' / '))) {
                                        expirationError.textContent = '';
                                    } else {
                                        expirationError.textContent = 'Invalid expiration date';
                                    }
                                } else {
                                    expirationError.textContent = '';
                                }
                            });

                            function validateExpiration(month, year) {
                                const currentYear = new Date().getFullYear() % 100; // Get the last 2 digits of the current year
                                const currentMonth = new Date().getMonth() + 1; // Get the current month (1-indexed)

                                // Convert the input month and year to numbers
                                month = parseInt(month, 10);
                                year = parseInt(year, 10);

                                // Check if the year is in the future or the current year and month are not past the input year and month
                                return (year > currentYear || (year === currentYear && month >= currentMonth));
                            }

                            const formWrapper = document.getElementById('form-wrapper');
                            const thanksButton = document.getElementById('thanks');
                            const thanksButtonMobile = document.getElementById('thanks-mobile');

                            function toggleForm(event) {
                                event.preventDefault();
                                formWrapper.classList.toggle('hidden');
                            }

                            thanksButton.addEventListener('click', toggleForm);
                            thanksButtonMobile.addEventListener('click', toggleForm);

                            document.addEventListener('keydown', (event) => {
                                if (event.key === 'Escape') {
                                    formWrapper.classList.add('hidden');
                                }
                            });

                            const endpoint = "{{ to()->api->thanks() }}";
                            const form = document.querySelector('#thanks-form');

                            form.addEventListener('submit', (event) => {
                                event.preventDefault();
                                if (!validateExpiration(...getCvcInput().split(' / '))) {
                                    expirationError.textContent = 'Invalid expiration date';

                                    return;
                                }
                                const submitButton = document.getElementById('submit');
                                submitButton.innerHTML = 'Processing ...';
                                submitButton.disabled = true
                                const formData = new FormData(form);
                                fetch(endpoint, {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Authorization': 'Bearer {{ $token }}',
                                    },
                                    body: formData
                                })
                                    .then(response => response.json())
                                    .then(submit)
                                    .catch(error => console.error(error))
                                    .finally(() => {
                                        submitButton.disabled = false;
                                        submitButton.innerHTML = 'Buy and Send';
                                    });

                                function submit(data) {
                                    const submitButton = document.getElementById('submit');
                                    submitButton.innerHTML = 'Buy and Send';

                                    const fields = {
                                        'email': {errorId: 'email-errors', inputId: '{{$email}}'},
                                        'card_number': {errorId: 'card-errors', inputId: '{{$card_number}}'},
                                        'cvc': {errorId: 'cvc-errors', inputId: '{{$cvc}}'},
                                        'expiration': {errorId: 'expiration-errors', inputId: '{{$expiration}}'}
                                    };

                                    Object.keys(fields).forEach((fieldName) => {
                                        const field = fields[fieldName];
                                        const error = data.errors?.[fieldName];
                                        const errorElement = document.getElementById(field.errorId);
                                        const inputElement = document.getElementById(field.inputId);

                                        if (error) {
                                            errorElement.innerHTML = error[0];
                                            inputElement.classList.add('ring-red-500');
                                        } else {
                                            errorElement.innerHTML = '';
                                            inputElement.classList.remove('ring-red-500');
                                        }
                                    });
                                    const messageSuccess = document.getElementById('message-errors');

                                    if (data.message && data?.message !== 'success') {
                                        messageSuccess.innerHTML = data.message || '';
                                    }
                                    if (data.message && data?.message === 'success') {
                                        const messageElement = document.getElementById('message-success');
                                        messageElement.classList.remove('hidden');
                                        messageSuccess.innerHTML = '';
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                @vite('resources/js/share.js')
                @if($post->premiere_at !== null && $post->premiere_at?->gt(now()))
                    @if(auth()->user()?->subscribed_at !== null)
                        <div id="published-content" class="grid max-w-none px-2 published-content prose">
                            @if($post->post_type_id !== PostTypes::animation)
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center">
                                <span class="bg-white px-2 text-gray-500 flex gap-2">
                                    <span class="my-auto">
                                         <x-svg :name="'clock-rotate-left'"/>
                                    </span>
                                    Early Access
                                </span>
                                    </div>
                                </div>
                            @endif
                            {!! $post->published_public_content !!}
                            @if($post->published_exclusive_content !== null)
                                <x-a :href="to()->subscribe()" class="pt-6 !no-underline">
                                    <div class="relative">
                                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                            <div class="w-full border-t border-gray-300"></div>
                                        </div>
                                        <div class="relative flex justify-center">
                                        <span class="bg-white px-2 text-gray-500 flex gap-2">
                                            <x-svg :name="auth()->user()?->subscribed_at === null ? 'locked' : 'unlocked'"/>
                                            Exclusive Content
                                        </span>
                                        </div>
                                    </div>
                                </x-a>
                                {!! $post->published_exclusive_content !!}
                            @endif
                        </div>
                    @else
                        @if($post->post_type_id !== PostTypes::animation)
                            <x-a :href="to()->subscribe()" class="block py-12 text-center text-2xl bg-gray-100">
                                <p>Premieres {{$post->premiere_at->tz('EST')->format('M d, Y')}}</p>
                                <p>{{$post->premiere_at->tz('EST')->format('h:i A e')}}</p>
                                <div class="flex justify-center mt-6">
                                    <div title="Go to Subscribe Page"
                                         class="btn flex gap-1">
                                        <x-svg :name="'unlocked-white'"/>
                                        Subscribe for instant access
                                    </div>
                                </div>
                            </x-a>
                        @endif
                        <div id="published-content" class="grid max-w-none px-2 published-content prose">
                            {!! $post->published_cta !!}
                        </div>
                        <div class="flex justify-center">
                            <x-a :href="to()->subscribe()"
                                 title="Go to Subscribe Page"
                                 class="btn flex gap-1">
                                <x-svg :name="'unlocked-white'"/>
                                Subscribe for exclusive content
                            </x-a>
                        </div>
                    @endif
                @else
                    <div id="published-content" class="grid max-w-none px-2 published-content prose">
                        {!! $post->published_public_content !!}
                        @if($post->published_exclusive_content !== null)
                            <x-a :href="to()->subscribe()" class=" pt-6 !no-underline">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center">
                                        <span class="bg-white px-2 text-gray-500 flex gap-2">
                                            <x-svg :name="auth()->user()?->subscribed_at === null ? 'locked' : 'unlocked'"/>
                                            Exclusive Content
                                        </span>
                                    </div>
                                </div>
                            </x-a>
                        @else
                            <div class="flex justify-center py-4">
                                <x-a :href="to()->subscribe()"
                                     title="Go to Subscribe Page"
                                     class="btn flex gap-1 no-underline">
                                    <x-svg :name="'unlocked-white'"/>
                                    Subscribe for exclusive content
                                </x-a>
                            </div>
                        @endif
                        @if(auth()->user()?->subscribed_at !== null)
                            {!! $post->published_exclusive_content !!}
                        @else
                            @if($post->published_exclusive_content !== null)
                                {!! $post->published_cta !!}
                            @endif
                        @endif
                    </div>
                    @if($post->published_exclusive_content !== null && auth()->user()?->subscribed_at === null)
                        <div class="flex justify-center">
                            <x-a :href="to()->subscribe()"
                                 title="Go to Subscribe Page"
                                 class="btn flex gap-1">
                                <x-svg :name="'unlocked-white'"/>
                                Subscribe for instant access
                            </x-a>
                        </div>
                    @endif
                @endif
            </article>
        </div>
        <?php
        $posts = Post::related($post->tags, $post->id)->get();
        [$latest_posts, $older_posts] = $posts->partition(
            fn(Post $post) => $post->original_publish_date->gt(now()->subDays(3))
        );
        ?>
        <div class="3col:flex hidden shrink-0 flex-col gap-2 w-[400px]">
            @foreach($latest_posts->merge($older_posts) as $post)
                <x-a :href="to()->read($post)" class="flex flex-row gap-2">
                    <div class="relative shrink-0">
                        <div class="relative overflow-hidden 2col:rounded-lg h-[112px] w-[168px]">
                            @if($post->post_type_id === PostTypes::animation)
                                <x-img class="absolute top-0 h-full w-full object-cover object-center hover:opacity-0 z-10"
                                       :file="$post->animationFile"
                                       :width="250"
                                       :title="''"
                                />
                                <x-img class="absolute top-0 h-full w-full object-cover object-center block"
                                       :file="$post->altFile"
                                       :width="250"
                                       :title="''"
                                />
                            @else
                                <x-img class="object-cover object-center"
                                       :file="$post->file"
                                       :width="250"
                                       :title="''"
                                />
                            @endif
                        </div>
                        <x-reading-time-chip :post="$post"/>
                    </div>
                    <div class="text-sm">
                        <h3 class="mb-1 font-bold leading-5 tracking-tight break-word"
                            title="{{ $post->title }}">{{ $post->title }}</h3>
                        <p class="tracking-tight"
                           title="{{$post->authorList()}}">{{$post->authorList()}}</p>
                        <x-views-date-line :post="$post"/>
                    </div>
                </x-a>
            @endforeach
        </div>
        <div class="mt-12 3col:hidden space-y-2 px-2">
            <h3 class="my-auto 2col:ml-0 ml-2 text-lg font-semibold">Related</h3>
            <x-divider class="pt-2"/>
            <x-post-responsive :posts="$posts"/>
        </div>
    </div>
</x-main>
