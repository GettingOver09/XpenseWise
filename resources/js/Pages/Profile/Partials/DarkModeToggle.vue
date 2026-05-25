<script setup>
import { useThemeStore } from '@/Stores/theme';

const themeStore = useThemeStore();
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Appearance
            </h2>

            <p class="mt-1 text-sm text-muted">
                Toggle between light and dark mode.
            </p>
        </header>

        <div class="mt-6 flex items-center gap-4">
            <label class="relative flex items-center cursor-pointer">
                <input
                    type="checkbox"
                    class="sr-only peer"
                    :checked="themeStore.theme === 'dark'"
                    @change="themeStore.toggleTheme()"
                >

                <div class="w-12 h-6 bg-gray-300 dark:bg-gray-700 rounded-full peer peer-checked:bg-primary transition-colors" />

                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-all peer-checked:translate-x-6" />
            </label>

            <span class="text-sm text-ctext font-medium">
                {{ themeStore.theme === 'dark' ? 'Dark Mode' : 'Light Mode' }}
            </span>
        </div>

    </section>
</template>