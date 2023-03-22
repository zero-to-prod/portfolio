<?php

use App\Models\User;

/* @var User $user */
?>

<div class="mx-auto max-w-[380px] min-h-[300px]">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label class="text-sm font-bold" for="password">Password</label>
            <input wire:model.lazy="password"
                   @class([
                        'text-lg input',
                        'ring-red-500' => $errors->has('password'),
                   ])
                   id="password"
                   type="password"
                   name="password"
                   value="{{old('password')}}"
            />
            @error('password') <p class="text-sm font-bold text-error">{{ $message }}</p> @enderror
        </div>
        <button wire:loading.attr="disabled" class="font-bold btn btn-wide">
            Submit
        </button>
    </form>
</div>
