<div x-data="{ selected: 'year' }" id="subscribe">
    <div class="mx-4 mx-auto mt-2 2col:mt-6 flex flex-wrap justify-center gap-4">
        <div class="card" @click="selected='month'" :class="selected === 'month' ? 'active' : ''">
            <div class="flex justify-between">
                <div>
                    <h2>Monthly</h2>
                    <h3>$6/month</h3>
                </div>
                <x-svg style="display: none" x-show="selected === 'month'" :name="'check-green'"/>
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
        <div @click="selected='year'" class="card" :class="selected === 'year' ? 'active' : ''">
            <div class="flex justify-between">
                <div>
                    <h2>Yearly</h2>
                    <h3>$60/year ($5/month)</h3>
                </div>
                <x-svg style="display: none" x-show="selected === 'year'" :name="'check-green'"/>
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
        <div @click="selected='member'" :class="selected === 'member' ? 'active' : ''" class="card">
            <div class="flex justify-between">
                <div>
                    <h2>Member</h2>
                    <h3>Free - with login</h3>
                </div>
                <x-svg style="display: none" x-show="selected === 'member'" :name="'check-green'"/>
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
        <div @click="selected='none'" :class="selected === 'none' ? 'active' : ''" class="card">
            <div class="flex justify-between">
                <div>
                    <h2>None</h2>
                    <h3>Free - no email required</h3>
                </div>
                <x-svg style="display: none" x-show="selected === 'none'" :name="'check-green'"/>
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
    <x-divider class="py-8 !block "/>
    <div class="mx-auto max-w-[380px] min-h-[300px] ">
        <div x-show="selected === 'member'" style="display: none">
            <x-a :href="to()->register->index()"
                 class="flex rounded-lg border-2 border border-gray-300 border-sky-600 p-2 font-bold hover:shadow-lg">
                <span class="mx-auto">Continue to Register for Free</span>
            </x-a>
        </div>
        <div x-show="selected === 'none'" style="display: none">
            <x-a :href="to()->welcome()"
                 class="flex rounded-lg border-2 border border-gray-300 border-sky-600 p-2 font-bold hover:shadow-lg">
                <span class="mx-auto">Continue to Without Paying</span>
            </x-a>
        </div>
        <div id="form-wrapper" x-show="selected === 'year' || selected === 'month'" x-transition.opacity>
            <form id="form" class="space-y-4">
                <div>
                    <label class="text-sm font-bold" for="email">Email</label>
                    <input class="text-lg input"
                           id="email"
                           type="email"
                           name="email"
                           value="{{old('email')}}"
                           placeholder="Your email address"
                           required
                    />
                    <p id="email-errors" class="text-sm font-bold text-error"></p>
                </div>
                <div>
                    <p class="text-sm font-bold">Card Information</p>
                    <label for="card_number" class="sr-only">Card number</label>
                    <input class="rounded-br-none rounded-bl-none text-lg input tracking-[.2rem]"
                           autocomplete="cc-number"
                           autocorrect="off"
                           spellcheck="false"
                           id="card_number"
                           name="card_number"
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
                        <label for="$expiration" class="sr-only">Expiration Month</label>
                        <input class="rounded-none rounded-bl text-lg input -mt-[1px] -mr-[.5px]"
                               autocomplete="cc-exp"
                               autocorrect="off"
                               spellcheck="false"
                               id="$expiration"
                               name="$expiration"
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
                        <label for="cvc" class="sr-only">CVC</label>
                        <input class="rounded-none rounded-br text-lg input -mt-[1px] -ml-[.5px]"
                               autocomplete="cc-csc"
                               autocorrect="off"
                               spellcheck="false"
                               id="cvc"
                               name="cvc"
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
                <button id="submit" class="font-bold btn btn-wide">Subscribe</button>
                <div id="message-success" class="hidden text-sm font-bold">
                    <p class="flex gap-1">
                        <x-svg :name="'check-green'"/>
                        <span class="my-auto">Thank you for supporting! A receipt will be sent to your email</span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>