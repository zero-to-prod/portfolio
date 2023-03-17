<x-subscribe id="subscribe" class="mx-auto my-4 max-w-7xl 2col:py-16" :title="'Subscribe'">
    <x-logo class="justify-center"/>
    <h1 class="mt-6 text-center text-2xl 2col:text-3xl font-bold">Choose a subscription plan</h1>
    <div class="mx-4 mx-auto mt-2 2col:mt-6 flex flex-wrap justify-center gap-4">
        <div class="card">
            <div>
                <h2>Monthly</h2>
                <h3>$6/month</h3>
            </div>
            <ul>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Access to Public Content</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Social Reactions</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Early Access</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Exclusive Content</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Save %17</span>
                </li>
            </ul>
        </div>
        <div class="card active">
            <div>
                <h2>Yearly</h2>
                <h3>$60/year ($5/month)</h3>
            </div>
            <ul>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Access to Public Content</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Social Reactions</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Early Access</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Exclusive Content</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Save %17</span>
                </li>
            </ul>
        </div>
        <div class="card">
            <div>
                <h2>Member</h2>
                <h3>Free - with login</h3>
            </div>
            <ul>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Access to Public Content</span>
                </li>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Social Reactions</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Early Access</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Exclusive Content</span>
                </li>
            </ul>
        </div>
        <div class="card">
            <div>
                <h2>None</h2>
                <h3>Free - no email</h3>
            </div>
            <ul>
                <li>
                    <x-svg :name="'check-green'"/>
                    <span>Access to Public Content</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Social Reactions</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Early Access</span>
                </li>
                <li class="flex gap-2 line-through">
                    <x-svg :name="'x-gray'"/>
                    <span>Exclusive Content</span>
                </li>
            </ul>
        </div>
    </div>
</x-subscribe>
