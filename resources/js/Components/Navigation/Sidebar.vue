<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import navigation from '@/Data/navigation.js';

const page = usePage();

const isActive = (href) => {
    return page.url === href;
};
</script>

<template>
    <aside class="w-64 min-h-screen border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <!-- Brand Logo -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                XpenseWise
            </h1>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col gap-2 p-4">
             <Link
                v-for="item in navigation"
                :key="item.href"
                :href="item.href"
                class="px-4 py-3 rounded-lg transition"
                :class="[
                    isActive(item.href)
                        ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white'
                        : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white'
                ]"
            >
                {{ item.label }}
            </Link>
        </nav>
    </aside>
</template>