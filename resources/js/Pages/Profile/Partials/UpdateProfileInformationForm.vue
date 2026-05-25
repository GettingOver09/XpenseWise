<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const submit = () => {
    form.patch('/profile');
};
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-muted">
                Update your account information.
            </p>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
        >

            <div>
                <label class="block text-sm font-medium text-ctext">
                    Name
                </label>

                <input
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-primary focus:ring-primary"
                >

                <p
                    v-if="form.errors.name"
                    class="mt-2 text-sm text-red-500"
                >
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-ctext">
                    Email
                </label>

                <input
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-primary focus:ring-primary"
                >

                <p
                    v-if="form.errors.email"
                    class="mt-2 text-sm text-red-500"
                >
                    {{ form.errors.email }}
                </p>
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="px-3 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition"
            >
                Save Changes
            </button>

        </form>

    </section>
</template>