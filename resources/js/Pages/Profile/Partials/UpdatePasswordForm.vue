<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put('/password', {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-muted">
                Ensure your account uses a secure password.
            </p>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
        >

            <input
                v-model="form.current_password"
                type="password"
                placeholder="Current Password"
                class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700"
            >

            <input
                v-model="form.password"
                type="password"
                placeholder="New Password"
                class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700"
            >

            <input
                v-model="form.password_confirmation"
                type="password"
                placeholder="Confirm Password"
                class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700"
            >

            <button
                type="submit"
                :disabled="form.processing"
                class="px-4 py-2 bg-primary text-white rounded-lg"
            >
                Save
            </button>

        </form>

    </section>
</template>