<div x-data="{ plan: @entangle('plan') }" id="subscribe">
    <div class="mx-4 mx-auto mt-2 2col:mt-6 flex flex-wrap justify-center gap-4">
        <div class="card" @click="plan='month'" :class="plan === 'month' ? 'active' : ''">
            <div class="flex justify-between">
                <div>
                    <h2>Monthly</h2>
                    <h3>$6/month</h3>
                </div>
                <x-svg style="display: none" x-show="plan === 'month'" :name="'check-green'"/>
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
        <div @click="plan='year'" class="card" :class="plan === 'year' ? 'active' : ''">
            <div class="flex justify-between">
                <div>
                    <h2>Yearly</h2>
                    <h3>$60/year ($5/month)</h3>
                </div>
                <x-svg style="display: none" x-show="plan === 'year'" :name="'check-green'"/>
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
        <div @click="plan='member'" :class="plan === 'member' ? 'active' : ''" class="card">
            <div class="flex justify-between">
                <div>
                    <h2>Member</h2>
                    <h3>Free - with login</h3>
                </div>
                <x-svg style="display: none" x-show="plan === 'member'" :name="'check-green'"/>
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
        <div @click="plan='none'" :class="plan === 'none' ? 'active' : ''" class="card">
            <div class="flex justify-between">
                <div>
                    <h2>None</h2>
                    <h3>Free - no email required</h3>
                </div>
                <x-svg style="display: none" x-show="plan === 'none'" :name="'check-green'"/>
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
        <div x-show="plan === 'member'" style="display: none">
            <x-a :href="to()->register->index()"
                 class="flex rounded-lg border-2 border border-gray-300 border-sky-600 p-2 font-bold hover:shadow-lg">
                <span class="mx-auto">Continue to Register for Free</span>
            </x-a>
        </div>
        <div x-show="plan === 'none'" style="display: none">
            <x-a :href="to()->welcome()"
                 class="flex rounded-lg border-2 border border-gray-300 border-sky-600 p-2 font-bold hover:shadow-lg">
                <span class="mx-auto">Continue to Without Paying</span>
            </x-a>
        </div>
        <div id="form-wrapper" x-show="plan === 'year' || plan === 'month'" x-transition.opacity>
            <form wire:submit.prevent="submit" class="space-y-4">
                <input wire:model="plan" type="hidden" name="plan"/>
                <div>
                    <label class="text-sm font-bold" for="email">Email</label>
                    @error('email') <p class="text-sm font-bold text-error">{{ $message }}</p> @enderror
                    <input wire:model.lazy="email"
                           @class([
                                 'text-lg input',
                                 'ring-red-500' => $errors->has('email'),
                                 ])
                           id="email"
                           type="email"
                           name="email"
                           value="{{old('email')}}"
                           required
                           placeholder="Your email address"
                    />
                </div>
                <div>
                    <p class="text-sm font-bold">Card Information</p>
                    @error('card') <span class="text-sm font-bold text-error">{{ $message }}</span> @enderror
                    <label for="card" class="sr-only">Card number</label>
                    <input wire:model.lazy="card"
                           @class([
                              'input text-lg rounded-none rounded-t',
                              'ring-red-500' => $errors->has('card'),
                          ])
                           autocomplete="cc-number"
                           spellcheck="false"
                           id="card"
                           name="card"
                           type="text"
                           inputmode="numeric"
                           aria-label="Card number"
                           placeholder="1234 1234 1234 1234"
                           aria-invalid="false"
                           value=""
                           required
                           minlength="13"
                           maxlength="19"
                    />
                    <div class="flex">
                        <label for="month" class="sr-only">Expiration Month</label>
                        <select wire:model="month"
                                @class([
                                    'rounded-none rounded-bl text-lg input -mr-[.5px]',
                                    'ring-red-500' => $errors->has('month'),
                                ])
                                autocomplete="cc-exp-month"
                                spellcheck="false"
                                id="month"
                                name="month"
                                type="text"
                                required
                                inputmode="numeric"
                                aria-label="Expiration Month"
                                aria-invalid="false"
                        >
                            <option value="" selected disabled>MM</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <label for="year" class="sr-only">Expiration Year</label>
                        <select wire:model="year"
                                @class([
                                    'rounded-none rounded-bl text-lg input -mr-[.5px]',
                                    'ring-red-500' => $errors->has('year'),
                                ])
                                autocomplete="cc-exp-year"
                                spellcheck="false"
                                id="year"
                                name="year"
                                type="text"
                                required
                                inputmode="numeric"
                                aria-label="Expiration Year"
                                aria-invalid="false"
                        >
                            <option value="" selected disabled>YY</option>
                            @for($i = 0; $i < 12; $i++)
                                <option value="{{date('y') + $i}}">{{date('y') + $i}}</option>
                            @endfor
                        </select>
                        <label for="cvc" class="sr-only">CVC</label>
                        <input wire:model.lazy="cvc"
                               @class([
                                   'rounded-none rounded-br text-lg input -ml-[.5px]',
                                   'ring-red-500' => $errors->has('cvc'),
                               ])
                               autocomplete="cc-csc"
                               spellcheck="false"
                               id="cvc"
                               name="cvc"
                               type="text"
                               inputmode="numeric"
                               aria-label="CVC"
                               placeholder="CVC"
                               aria-invalid="false"
                               value=""
                               required
                               minlength="3"
                               maxlength="4"
                        />
                    </div>
                    <div class="text-sm font-bold text-error">
                        @error('month') <p>{{ $message }}</p> @enderror
                        @error('year') <p>{{ $message }}</p> @enderror
                        @error('cvc') <p>{{ $message }}</p> @enderror
                        @error('stripe') <p>{{ $message }}</p> @enderror
                    </div>
                </div>
                <button class="font-bold btn btn-wide">Subscribe</button>
            </form>
        </div>
    </div>
</div>