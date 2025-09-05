<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="username" :value="__('Username / Email')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div x-data="{ show: false }" class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" x-bind:type="show ? 'text' : 'password'"
                    name="password" required autocomplete="current-password" />

                <!-- Toggle button -->
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">

                    <!-- Mata terbuka -->
                    <span x-show="!show" class="material-symbols-outlined">
                        visibility
                    </span>

                    <!-- Mata tertutup -->
                    <span x-show="show" class="material-symbols-outlined">
                        visibility_off
                    </span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded text-primary shadow-sm focus:ring-primary"
                    name="remember">
                <span class="ms-2 text-sm text-primary">{{ __('Ingatkan saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="mr-4 underline text-sm text-primary hover:text-primary/70 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                href="{{ route('register') }}">
                {{ __('Daftar') }}
            </a>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-primary hover:text-primary/70 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password ?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
