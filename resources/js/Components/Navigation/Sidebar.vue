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
    <aside class="w-64 min-h-screen border-r border-gray-200 dark:border-gray-700 bg-background">
        <!-- Brand Logo -->
        <div class="p-[18px] border-b border-muted/20 dark:border-gray-700">
            <h1 class="text-xl font-bold text-ctext">
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
                        ? 'bg-gray-200 dark:bg-gray-700 text-ctext'
                        : 'text-muted hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-ctext'
                ]"
            >
                {{ item.label }}
            </Link>
        </nav>
    </aside>
</template>