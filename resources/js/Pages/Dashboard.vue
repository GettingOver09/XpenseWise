<script setup>
import { useThemeStore } from '@/stores/theme';
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

// Use Pinia (recommended for Vue)
const themeStore = useThemeStore();

defineOptions({
    name: 'Dashboard',
    layout: AppLayout,
});
</script>

<template>
    <div class="min-h-screen bg-background text-ctext">
        <Head title="Dashboard" />

        <div class="mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-ctext dark:text-white">
                    Dashboard
                </h1>

                <!-- Theme Toggle Button -->
                <button
                    @click="themeStore.toggleTheme"
                    class="p-3 rounded-2xl bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                >
                    <span v-if="themeStore.theme === 'dark'" class="text-2xl">☀️</span>
                    <span v-else class="text-2xl">🌙</span>
                </button>
            </div>

            <!-- Test Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow">
                    <h3 class="text-lg font-medium text-ctext dark:text-white">Total Balance</h3>
                    <p class="text-4xl font-bold mt-2 text-emerald-600 dark:text-emerald-400">₱48,250.75</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow">
                    <h3 class="text-lg font-medium text-ctext dark:text-white">This Month Expenses</h3>
                    <p class="text-4xl font-bold mt-2 text-red-600 dark:text-red-400">-₱12,480.00</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow">
                    <h3 class="text-lg font-medium text-ctext dark:text-white">Budgets Used</h3>
                    <p class="text-4xl font-bold mt-2 text-amber-600 dark:text-amber-400">68%</p>
                </div>
            </div>

            <div class="mt-10 bg-white dark:bg-gray-800 rounded-3xl p-8">
                <p class="text-center text-gray-500 dark:text-gray-400">
                    Dark mode should now work consistently between Blade pages and this Inertia Dashboard.<br>
                    Try toggling from here and then go to a Blade page (like Profile).
                </p>
            </div>
        </div>
    </div>
</template>