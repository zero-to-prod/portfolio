<?php

use App\Http\Livewire\Newsletter;

$email = Newsletter::email;
$form_errors = Newsletter::errors;
?>
<div>
    <form wire:submit.prevent="submit" class="mt-6 mx-auto" id="form">
        <label for="{{$email}}" class="sr-only">Email</label>
        <div class="flex flex-col 2col:flex-row gap-2">
            <input wire:model="{{$email}}"
                   @class([
                      'input text-lg text-center 2col:text-left rounded-lg',
                      'ring-red-500' => $errors->has($email),
                  ])
                   id="{{$email}}"
                   type="email"
                   name="{{$email}}"
                   required
                   placeholder="Your email address"/>
            <button wire:loading.attr="disabled" title="Subscribe to Newsletter"
                    class="btn flex justify-center shrink-0 px-3 py-2">
                <span wire:loading.remove.delay>
                                <span class="my-auto mx-auto flex gap-2">
                                    <x-svg :name="'mail-dark'" class="!h-6 !w-6"/>
                                    <span class="my-auto font-bold text-white">Subscribe</span>
                                </span>
                </span>
                <span wire:loading.delay>Processing...</span>
            </button>
        </div>
    </form>
    <div class="mx-1 text-left text-xs">
        @error($email) <p class="mt-2 text-red-500">{{ $message }}</p> @enderror
        @error($form_errors) <p class="error">{{ $message }}</p> @enderror
        <div class="mt-2 ">
            <p>
                We'll never share your email address, and you can opt out at any
                time.
            </p>
            <p>No spam, ever.</p>
        </div>
    </div>
</div>
