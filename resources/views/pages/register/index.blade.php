<?php

use App\Http\Controllers\Register\Store as Controller;
use Spatie\SchemaOrg\Schema;

$name = Controller::name;
$email = Controller::email;
$password = Controller::password;
$confirmation = Controller::password_confirmation;
?>
<x-login :title="'Register' . ' | ' . config('app.name')" :description="'Register'">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Register')->url(to()->register->index())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <h1 class="border-b border-gray-300 text-sm bg-base-200 p-4">
        Create an Account
    </h1>
    <p class="sr-only">Sign Up to get access to public content and social features!</p>
    <div class="p-4 space-y-4">
        <form class="space-y-4" method="POST" action="{{ to()->register->store() }}">
            @csrf
            <x-form-control>
                <label for="{{$name}}">Name*</label>
                <input name="{{$name}}"
                       id="{{$name}}"
                       value="{{old($name)}}"
                       autocomplete="name"
                >
                @if($errors->has($name))
                    <p>{{ $errors->first($name) }}</p>
                @endif
            </x-form-control>
            <x-form-control>
                <label for="{{$email}}">Email*</label>
                <input name="{{$email}}"
                       id="{{$email}}"
                       value="{{old($email)}}"
                       type="email"
                       autocomplete="email"
                >
                @if($errors->has($email))
                    <p>{{ $errors->first($email) }}</p>
                @endif
            </x-form-control>
            <x-form-control>
                <label for="{{$password}}">Password*</label>
                <input name="{{$password}}"
                       id="{{$password}}"
                       value="{{old($password)}}"
                       type="password"
                       autocomplete="password"
                >
                @if($errors->has($password))
                    <p>{{ $errors->first($password) }}</p>
                @endif
            </x-form-control>
            <x-form-control>
                <label for="{{$confirmation}}">Confirm Password*</label>
                <input name="{{$confirmation}}"
                       id="{{$confirmation}}"
                       value="{{old($confirmation)}}"
                       type="password"
                       autocomplete="password"
                >
                @if($errors->has($confirmation))
                    <p>{{ $errors->first($confirmation) }}</p>
                @endif
            </x-form-control>
            <button class="btn btn-wide">Continue</button>
        </form>
    </div>
</x-login>

