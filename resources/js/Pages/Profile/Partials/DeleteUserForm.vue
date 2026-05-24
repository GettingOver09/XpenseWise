<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const showModal = ref(false);

const form = useForm({
    password: '',
});

const deleteAccount = () => {
    form.delete('/profile', {
        preserveScroll: true,
    });
};
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-red-500">
                Delete Account
            </h2>

            <p class="mt-1 text-sm text-muted">
                Permanently delete your account and data.
            </p>
        </header>

        <button
            @click="showModal = true"
            class="mt-6 px-4 py-2 bg-red-500 text-white rounded-lg"
        >
            Delete Account
        </button>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        >

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl p-6 w-full max-w-md"
            >

                <h3 class="text-lg font-semibold text-ctext">
                    Confirm Deletion
                </h3>

                <p class="mt-2 text-sm text-muted">
                    Enter your password to confirm.
                </p>

                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    class="mt-4 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700"
                >

                <div class="mt-6 flex justify-end gap-3">

                    <button
                        @click="showModal = false"
                        class="px-4 py-2 rounded-lg border"
                    >
                        Cancel
                    </button>

                    <button
                        @click="deleteAccount"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg"
                    >
                        Delete
                    </button>

                </div>

            </div>

        </div>

    </section>
</template>