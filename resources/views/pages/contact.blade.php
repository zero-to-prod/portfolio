<?php

use App\Http\Controllers\Store;
use Spatie\SchemaOrg\Schema;

$email = Store::email;
$subject = Store::subject;
$body = Store::body;

?>
<x-main :title="'Contact Us' . ' - ' . config('app.name')"
        :description="'Get in touch with '.config('app.name').' with your questions, media requests, or other support-related inquiries. Our support team will respond as soon as possible.'">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Contact')->url(to()->contact())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    @if(session()->has($email))
        <x-toast>
            <p>Message sent!</p>
            <p>You will be contacted via email at: {{session()->get($email)}}</p>
        </x-toast>
    @endif
    <div class="sm:py-6 sm:py-12">
        <div class="px-6 lg:px-8 max-w-xl mx-auto py-8">
            <div class="mx-auto max-w-2xl text-center">
                <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Contact {{config('app.name')}}</h1>
                <p class="sr-only">Get in touch with {{config('app.name')}} with your questions, media requests, or other support-related inquiries. Our support team will respond as soon as possible.</p>
            </div>
            <form class="mx-auto mt-8 space-y-4" action="{{to()->contact_store()}}" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-y-4 gap-x-8 sm:grid-cols-2">
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
                        <label for="{{$subject}}">Subject*</label>
                        <input id="{{$subject}}"
                               value="{{old($subject)}}"
                               name="{{$subject}}"
                               autocomplete="organization">
                        @if($errors->has($subject))
                            <p>{{ $errors->first($subject) }}</p>
                        @endif
                    </x-form-control>
                    <x-form-control>
                        <label for="{{$body}}">Message</label>
                        <textarea name="{{$body}}"
                                  id="{{$body}}"
                                  rows="4">
                            {{old($body)}}
                        </textarea>
                        @if($errors->has($body))
                            )
                            <p>{{ $errors->first($body) }}</p>
                        @endif
                    </x-form-control>
                </div>
                <button class="btn btn-wide">Submit</button>
            </form>
        </div>
    </div>
</x-main>

