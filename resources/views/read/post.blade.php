<?php

use App\Http\Controllers\Api\ThanksResponse;
use App\Models\Post;
use Illuminate\Support\Collection;

/* @var Post $post */
/* @var File $feature */
/* @var Collection $tags */
$amount = ThanksResponse::amount;
$email = ThanksResponse::email;
$card_number = ThanksResponse::card_number;
$expiration = ThanksResponse::expiration;
$cvc = ThanksResponse::cvc;
?>

<x-main :title="$post->title">
    <div class="mx-auto justify-center block 3col:flex max-w-7xl 3col:flex-row gap-2">
        <div class="shrink max-w-[837px]">
            <div class="relative">
                <x-img class="h-full w-full object-cover object-center"
                       :file="$post->featuredImage()"
                       :width="837"
                       :title="''"
                />
                <x-reading-time-chip :post="$post" :text="' min read'"/>
            </div>
            <article class="space-y-6 2col:px-0 px-2" aria-label="Body">
                <div class="2col:block hidden space-y-2">
                    <div class="flex justify-between pt-2">
                        <div>
                            <h1 id="title" class="text-2xl font-bold">{{$post->title}}</h1>
                            <p id="subtitle" class="text-sm">{{$post->subtitle}}</p>
                        </div>
                        <div class="text-right text-sm">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="flex w-full mt-2 flex-wrap justify-between">
                        <x-a class="flex gap-2 font-semibold mr-4" :href="'#'">
                            <x-img class="h-10 w-10 rounded-full my-auto" :file="$post->authorAvatar()" :height="80"/>
                            <div class="flex flex-col">
                                <p class="underline">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authors->first()->posts()->count()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <div class="flex gap-2">
                            <div class="flex gap-2">
                                <x-logos :post="$post"/>
                            </div>
                            <button id="share" type="button" title="Share this content."
                                    class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300">
                                <x-svg :name="'share'" class="!h-6 !w-6"/>
                                <span class="text-sm font-bold my-auto">Share</span>
                            </button>
                            <button id="thanks" type="button"
                                    title="Buy a Thanks, which directly supports content like this."
                                    class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300">
                                <x-svg :name="'thanks'" class="!h-6 !w-6"/>
                                <span class="text-sm font-bold my-auto">Thanks</span>
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
                        <x-a class="flex gap-2 text-base font-semibold mr-4" :href="'#'">
                            <x-img class="h-10 w-10 rounded-full my-auto" :file="$post->authorAvatar()" :height="80"/>
                            <div>
                                <p class="underline">{{$post->authorList()}}</p>
                                <p class="text-sm">{{$post->authors->first()->posts()->count()}}
                                    Posts
                                </p>
                            </div>
                        </x-a>
                        <div class="text-right text-sm">
                            <x-published-date :post="$post"/>
                            <x-views :post="$post"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <x-logos :post="$post"/>
                        </div>
                        <button id="share-mobile" type="button"
                                class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300 ml-auto mr-2">
                            <x-svg :name="'share'" class="!h-6 !w-6"/>
                            <span class="text-sm font-bold my-auto">Share</span>
                        </button>
                        <button id="thanks" type="button"
                                title="Buy a Thanks, which directly supports content like this."
                                class="bg-gray-200 my-auto flex rounded-lg gap-2 p-2 hover:bg-gray-300">
                            <x-svg :name="'thanks'" class="!h-6 !w-6"/>
                            <span class="text-sm font-bold my-auto">Thanks</span>
                        </button>
                    </div>
                </div>
                <div id="form-wrapper" class="hidden border-t border-b my-4 py-4 ">
                    <div class="mx-auto max-w-[380px]">
                        <h3 class="text-xl font-bold">Say Thanks</h3>
                        <p class="text-sm">Buy a Thanks, and directly support content like this.</p>
                        <form id="form" class="space-y-4 mt-4">
                            <div class="flex gap-2 justify-center">
                                @foreach([1, 2, 5, 10] as $amount)
                                    <label class="flex items-center p-2 rounded-lg bg-gray-300 hover:bg-base-300 cursor-pointer">
                                        <input type="radio" id={{$amount}}1" name="amount" value="{{$amount}}"  {{$amount === 2 ? 'checked' : null}}>
                                        <x-svg :name="'thanks-white'"/>
                                        <span class="pl-2 font-bold">${{$amount}}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div>
                                <label class="font-bold text-sm" for="{{$email}}">Email</label>
                                <input class="input text-lg"
                                       id="{{$email}}"
                                       type="{{$email}}"
                                       name="{{$email}}"
                                       value="{{old($email)}}"
                                       placeholder="Your email address"
                                />
                                <p id="email-errors" class="text-error text-sm font-bold"></p>

                            </div>
                            <div>
                                <p class="font-bold text-sm">Card Information</p>
                                <label for="{{$card_number}}" class="sr-only">Card number</label>
                                <input class="input rounded-bl-none rounded-br-none  text-lg"
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
                                >
                                <div class="flex">
                                    <label for="{{$expiration}}" class="sr-only">Expiration Month</label>
                                    <input class="input -mt-[1px] -mr-[.5px] text-lg rounded-none rounded-bl"
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
                                    >
                                    <label for="{{$cvc}}" class="sr-only">CVC</label>
                                    <input class="input -mt-[1px] -ml-[.5px] text-lg rounded-none rounded-br"
                                           autocomplete="cc-csc" autocorrect="off" spellcheck="false" id="{{$cvc}}"
                                           name="{{$cvc}}" type="text" inputmode="numeric" aria-label="CVC"
                                           placeholder="CVC" aria-invalid="false" value="">
                                </div>
                                <div class="text-error text-sm font-bold">
                                    <p id="expiration-error"></p>
                                    <p id="card-errors"></p>
                                    <p id="cvc-errors"></p>
                                    <p id="expiration-errors"></p>
                                    <p id="message-errors"></p>
                                </div>
                            </div>
                            <button id="submit" class="btn btn-wide font-bold">Buy and Send</button>
                            <div id="message-success" class="hidden font-bold text-sm">
                                <p class="flex gap-1">
                                    <x-svg :name="'check-green'"/>
                                    <span class="my-auto">Thank you for supporting! A receipt will be sent to your email</span>
                                </p>
                            </div>
                        </form>
                        <script>
                            const expirationInput = document.getElementById('expiration');
                            const expirationError = document.getElementById('expiration-error');

                            expirationInput.addEventListener('input', (event) => {
                                // Remove any non-numeric characters
                                let input = event.target.value.replace(/\D/g, '');

                                // Add a slash between the month and year if the input length is greater than 2
                                if (input.length > 2) {
                                    input = input.slice(0, 2) + ' / ' + input.slice(2);
                                }

                                // Set the value of the input to the formatted value
                                event.target.value = input;

                                // Validate the input if the year is entered
                                if (input.length === 7) {
                                    const [month, year] = input.split(' / ');
                                    if (validateExpiration(month, year)) {
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

                            const thanksButton = document.getElementById('thanks');

                            thanksButton.addEventListener('click', (event) => {
                                event.preventDefault();
                                const formWrapper = document.getElementById('form-wrapper');
                                formWrapper.classList.toggle('hidden');
                            });

                            addEventListener('keydown', function (event) {
                                if (event.key === 'Escape') {
                                    const formWrapper = document.getElementById('form-wrapper');
                                    formWrapper.classList.add('hidden');
                                }
                            });

                            const endpoint = "{{ to()->api->thanks() }}";
                            const form = document.querySelector('#form');

                            form.addEventListener('submit', (event) => {
                                const submitButton = document.getElementById('submit');
                                submitButton.innerHTML = 'Processing ...';
                                event.preventDefault();
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
                <div class="grid max-w-none prose px-2">
                    {!! $post->published_content !!}
                </div>
            </article>
        </div>
        <?php
        $posts = Post::related($post->tags, $post->id);
        ?>
        <div class="3col:flex hidden shrink-0 flex-col gap-2 w-[400px]">
            @foreach($posts as $post)
                <x-a :href="to()->web->read($post)" class="flex flex-row gap-2">
                    <div class="relative shrink-0">
                        <div class="overflow-hidden 2col:rounded-lg">
                            <x-img class="object-cover object-center h-[112px] w-[168px]"
                                   :file="$post->featuredImage()"
                                   :width="250"
                                   :title="''"
                            />
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
        {{--        <div id="cta"--}}
        {{--             class="p-4 rounded-lg bg-gray-100 btn-ghost cursor-pointer flex justify-between shadow-lg">--}}
        {{--            <div class="flex gap-2">--}}
        {{--                <x-svg :name="'mail'"/>--}}
        {{--                <span class="my-auto font-bold">Stay up to date</span>--}}
        {{--            </div>--}}
        {{--            <p class="my-auto text-sm">Show more...</p>--}}
        {{--        </div>--}}

        <div class="mt-12 space-y-2 3col:hidden">
            <h3 class="my-auto text-lg font-semibold">Related</h3>
            <x-divider class="pt-2"/>
            <x-post-responsive :posts="$posts"/>
        </div>
    </div>
</x-main>
