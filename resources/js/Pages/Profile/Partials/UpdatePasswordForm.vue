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

            <div>
                <label class="block text-sm font-medium text-ctext">
                    Current Password
                </label>
                <input
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-primary focus:ring-primary"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-ctext">
                    New Password
                </label>
                <input
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-primary focus:ring-primary"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-ctext">
                    Confirm New Password
                </label>
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-primary focus:ring-primary"
                >
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition"
            >
                Update Password
            </button>

        </form>

    </section>
</template>