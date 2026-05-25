<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import navigation from '@/Data/navigation.js';

const page = usePage();

const isActive = (href) => {
    return page.url === href;
};

const itemClasses = (item) => ([
    'flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left transition',
    item.href && isActive(item.href)
        ? 'bg-gray-200 text-ctext dark:bg-gray-700'
        : 'text-muted hover:bg-gray-100 hover:text-ctext dark:hover:bg-gray-700',
]);
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
            <div
                v-for="item in navigation"
                :key="item.label"
                :class="{ 'mt-6 border-t border-muted/20 pt-6 dark:border-gray-700': item.spacerBefore }"
            >
                <Link
                    v-if="item.href"
                    :href="item.href"
                    :class="itemClasses(item)"
                >
                    <component
                        :is="item.icon"
                        class="shrink-0"
                        size="22"
                    />
                    <span>{{ item.label }}</span>
                </Link>

                <button
                    v-else
                    type="button"
                    :class="itemClasses(item)"
                >
                    <component
                        :is="item.icon"
                        class="shrink-0"
                        size="22"
                    />
                    <span>{{ item.label }}</span>
                </button>
            </div>
        </nav>
    </aside>
</template>
