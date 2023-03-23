<x-login>
    <div class="border-b border-gray-300 text-sm bg-base-200 p-4">
        Verify Your Email Address
    </div>
    <div class="p-4 space-y-4">
        <h1 class="text-2xl">Thank You</h1>
        <p>You've just been sent an email to confirm your email address.</p>
        <p>Please click on the link in the email to confirm your Signup and access new features.</p>
        <p>
            <x-a :href="to()->welcome()" class="underline">Click here</x-a>
            to return to the home page.
        </p>
    </div>
</x-login>

