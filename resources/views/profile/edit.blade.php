<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ctext dark:text-ctext-dark leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div
                class="p-4 sm:p-8 bg-background dark:bg-background-dark shadow-lg dark:shadow-primary-dark sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div
                class="p-4 sm:p-8 bg-background dark:bg-background-dark shadow-lg dark:shadow-primary-dark sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <div
                class="p-4 sm:p-8 bg-background dark:bg-background-dark shadow-lg dark:shadow-primary-dark sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.darkmode-toggle')
                </div>
            </div>

            <!-- Delete Account -->
            <div
                class="p-4 sm:p-8 bg-background dark:bg-background-dark shadow-lg dark:shadow-primary-dark sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
