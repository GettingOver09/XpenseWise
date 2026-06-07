<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useThemeStore } from '@/stores/theme';

const themeStore = useThemeStore();

defineOptions({
    name: 'Dashboard',
    layout: AppLayout,
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-ctext">
                Dashboard
            </h1>

            <!-- Theme Toggle -->
            <button
                @click="themeStore.toggleTheme"
                class="p-3 rounded-2xl bg-gray-100 dark:bg-gray-800 bg-hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"
            >
                <span v-if="themeStore.theme === 'dark'" class="text-2xl">☀️</span>
                <span v-else class="text-2xl">🌙</span>
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-background border border-gray-200 dark:border-gray-700 rounded-3xl p-7 shadow-sm">
                <h3 class="text-sm font-medium text-muted">Total Balance</h3>
                <p class="text-4xl font-bold mt-3 text-emerald-600 dark:text-emerald-400">₱48,250.75</p>
            </div>

            <div class="bg-background border border-gray-200 dark:border-gray-700 rounded-3xl p-7 shadow-sm">
                <h3 class="text-sm font-medium text-muted">This Month Expenses</h3>
                <p class="text-4xl font-bold mt-3 text-red-600 dark:text-red-400">-₱12,480.00</p>
            </div>

            <div class="bg-background border border-gray-200 dark:border-gray-700 rounded-3xl p-7 shadow-sm">
                <h3 class="text-sm font-medium text-muted">Budgets Used</h3>
                <p class="text-4xl font-bold mt-3 text-amber-600 dark:text-amber-400">68%</p>
            </div>
        </div>

        <!-- Placeholder Content -->
        <div class="mt-10 bg-background border border-gray-200 dark:border-gray-700 rounded-3xl p-8">
            <p class="text-center text-muted">
                Welcome to your expense tracker dashboard.<br>
                Start adding transactions to see insights here.
            </p>
        </div>

    </div>
</template>