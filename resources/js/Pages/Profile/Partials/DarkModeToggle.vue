<script setup>
import { useThemeStore } from '@/Stores/theme';

const themeStore = useThemeStore();
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Dark Mode
            </h2>

            <p class="mt-1 text-sm text-muted">
                Toggle dark mode on or off.
            </p>
        </header>

        <div class="mt-5">
            <label class="relative flex items-center cursor-pointer">

                <input
                    type="checkbox"
                    class="sr-only peer"
                    :checked="themeStore.theme === 'dark'"
                    @change="themeStore.toggleTheme()"
                >

                <div
                    class="w-12 h-6 bg-gray-300 rounded-full transition peer-checked:bg-blue-600"
                />

                <div
                    class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-6"
                />

            </label>
        </div>

    </section>
</template>