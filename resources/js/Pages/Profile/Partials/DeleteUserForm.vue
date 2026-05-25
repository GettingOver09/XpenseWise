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
                Permanently delete your account and all associated data.
            </p>
        </header>

        <button
            @click="showModal = true"
            class="mt-6 px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition"
        >
            Delete Account
        </button>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        >
            <div class="bg-background border border-gray-200 dark:border-gray-700 rounded-2xl p-6 w-full max-w-md shadow-xl">
                
                <h3 class="text-lg font-semibold text-ctext">
                    Confirm Account Deletion
                </h3>

                <p class="mt-2 text-sm text-muted">
                    This action cannot be undone. Please enter your password to confirm.
                </p>

                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Enter your password"
                    class="mt-4 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 focus:border-red-500 focus:ring-red-500"
                >

                <div class="mt-6 flex justify-end gap-3">
                    <button
                        @click="showModal = false"
                        class="px-5 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-ctext hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                    >
                        Cancel
                    </button>

                    <button
                        @click="deleteAccount"
                        :disabled="form.processing"
                        class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition"
                    >
                        Yes, Delete Account
                    </button>
                </div>

            </div>
        </div>

    </section>
</template>