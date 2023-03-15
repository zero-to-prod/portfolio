<?php

use App\Models\Tag;
use App\Http\Controllers\Api\SubscribeResponse;

/* @var Tag $tag */
/* @var string $token */

$email = SubscribeResponse::email;
?>
<x-main :title="'Subscribe'">
    <div class="text-center pt-10 2col:pt-16 pb-32 max-w-3xl mx-auto space-y-10 px-2">
        <h1 class="text-6xl">Weekly Newsletter</h1>
        <div>
            <h2 class="text-2xl font-semibold">Want the best content?</h2>
            <p class="text-lg max-w-md mx-auto pt-4">
                We curate the best new information and deliver it to your inbox every Sunday morning.
            </p>
        </div>
        <div class="my-12">
            <div id="cta-expanded" class="p-4 rounded-lg bg-gray-200 shadow-lg">
                <div class="max-w-md mx-auto">
                    <p class="font-bold text-xl pt-4">The bleeding edge - to your inbox.</p>
                    <form class="mt-6 mx-auto" id="form">
                        <label for="{{$email}}" class="sr-only">Email</label>
                        <div class="flex flex-col 2col:flex-row gap-2">
                            <input class="input text-lg text-center 2col:text-left"
                                   id="{{$email}}"
                                   type="email"
                                   name="{{$email}}"
                                   required
                                   placeholder="Your email address"/>
                            <button id="submit" class="btn btn-xs text-lg">Subscribe</button>
                        </div>
                    </form>
                    <div class="mx-1 text-xs space-y-2 font-bold">
                        <p id="success" class="hidden mt-2">
                            Success! Welcome to the club. Check your inbox for new content.
                        </p>
                        <p id="error" class="hidden text-error">
                            Something went wrong! Try another email.
                        </p>
                        <p class="font-normal">
                            No spam, ever. We'll never share your email address, and you can opt out at any
                            time.
                        </p>
                    </div>
                </div>
            </div>
            <script>
                const getElement = (id) => document.querySelector(`#${id}`);
                const endpoint = "{{ to()->api->subscribe() }}";
                const ctaExpanded = getElement('cta-expanded');
                const success = getElement('success');
                const error = getElement('error');
                const email = getElement('email');
                const submit = getElement('submit');
                const form = getElement('form');
                let submitted = false;

                email.addEventListener('click', () => {
                    email.classList.remove('border', 'border-error');
                    email.classList.remove('bg-green-200');
                    if (submitted) {
                        email.value = '';
                        submitted = false;
                        success.classList.add('hidden');
                        error.classList.add('hidden');
                    }
                });

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    submitted = true;
                    submit.innerText = 'Submitting...';
                    submit.disabled = true;
                    success.classList.add('hidden');
                    error.classList.add('hidden');
                    const formData = new FormData(form);

                    try {
                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': 'Bearer {{ $token }}',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            email.classList.add('bg-green-200');
                            success.classList.toggle('hidden');
                        } else {
                            document.querySelector('#subscribe').reset();
                            email.classList.add('border', 'border-error');
                            error.classList.toggle('hidden');
                        }
                    } catch (e) {
                        email.classList.add('border', 'border-error');
                        error.classList.toggle('hidden');
                    } finally {
                        submit.innerText = 'Subscribe';
                        submit.disabled = false;
                    }
                });
            </script>
        </div>
        <div>
            <h2 class="text-xl font-bold">
                The Perfect Newsletter to Stay up to Date
            </h2>
            <div class="flex flex-wrap justify-center mt-4">
                @forEach($tags as $tag)
                    <p class="p-2 flex">
                        @if($tag->hasLogo())
                            <x-img class="w-10" :file="$tag->logo()" :width="80"/>
                        @endif
                        <span class="ml-2 my-auto">{{$tag->name}}</span>
                    </p>
                @endforeach
            </div>
        </div>

    </div>
</x-main>
