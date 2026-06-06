<script setup>
import { Head, usePage } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';

import DarkModeToggle from './Partials/DarkModeToggle.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineOptions({
    layout: AppLayout,
});

const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Profile" />

    <div class="space-y-6 px-6 py-6">
        <div>
            <h1 class="text-3xl font-bold text-ctext">
                Profile Settings
            </h1>

            <p class="text-muted mt-1">
                Manage your account settings and preferences.
            </p>
        </div>

        <div class="bg-background border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl p-6">
            <UpdateProfileInformationForm :user="user" />
        </div>

        <div class="bg-background border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl p-6">
            <UpdatePasswordForm />
        </div>

        <div class="bg-background border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl p-6">
            <DarkModeToggle />
        </div>

        <div class="bg-background border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl p-6">
            <DeleteUserForm />
        </div>

    </div>
</template>