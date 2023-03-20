<x-login>
    <div class="border-b border-gray-300 text-sm bg-base-200 p-4">
        Account Verification
    </div>
    <div class="p-4 space-y-4">
        <div class="mb-4 text-sm text-gray-600">
            Your account has been verified.
        </div>
        <x-a :href="to()->welcome()" class="underline">Click here</x-a> to return to the home page.
    </div>
</x-login>

