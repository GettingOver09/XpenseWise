<!-- resources/views/about.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ctext leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Content Section -->
            <div class="bg-background shadow-lg overflow-hidden sm:rounded-lg">
                <div class="p-6 text-ctext">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Our Mission') }}</h3>
                    <p class="mb-4">
                        {{ __("We're dedicated to providing the best experience for our users.") }}
                    </p>

                    <x-primary-button class="mt-4">
                        {{ __('Learn More') }}
                    </x-primary-button>
                </div>
            </div>

            <!-- Additional Section with Navigation -->
            <div>
                <x-text-link :href="route('dashboard')">
                    {{ __('Back to Dashboard') }}
                </x-text-link>
            </div>
        </div>
    </div>
</x-app-layout>
