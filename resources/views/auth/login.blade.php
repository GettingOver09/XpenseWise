<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-ctext dark:text-ctext-dark" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-background dark:bg-background-dark border border-gray-300 dark:border-gray-600 text-ctext dark:text-ctext-dark focus:ring-indigo-500 dark:focus:ring-indigo-400"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-ctext dark:text-ctext-dark" />

            <x-text-input id="password"
                class="block mt-1 w-full bg-background dark:bg-background-dark border border-gray-300 dark:border-gray-600 text-ctext dark:text-ctext-dark focus:ring-indigo-500 dark:focus:ring-indigo-400"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 dark:text-indigo-400 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-400"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button
                class="ms-3 bg-primary dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary focus:ring-indigo-500 dark:focus:ring-indigo-400">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
