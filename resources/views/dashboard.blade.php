<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ctext dark:text-ctext-dark leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- First Card -->
            <div
                class="overflow-hidden shadow-md dark:shadow-primary-dark sm:rounded-lg bg-background dark:bg-background-dark">

                <div class="p-6 text-ctext dark:text-ctext-dark">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Second Card -->
            <div>
                <x-text-link :href="route('about')">
                    {{ __('Go to About') }}

                </x-text-link>
            </div>
        </div>
    </div>
</x-app-layout>
