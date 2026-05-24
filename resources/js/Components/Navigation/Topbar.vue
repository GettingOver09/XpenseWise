<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const open = ref(false);

const page = usePage();

const user = page.props.auth?.user ?? {};

const isActive = (path) => {
    return page.url === path;
};
</script>

<template>
    <nav class="bg-background border-b border-gray-200 dark:border-gray-700">
        <div class="px-6">
            <div class="flex justify-between h-16">

                <!-- LEFT -->
                <div class="flex items-center gap-8">

                    <Link
                        href="/dashboard"
                        class="text-xl font-bold text-ctext"
                    >
                       Page Name
                    </Link>
                
                </div>

                <!-- RIGHT -->
                <div class="hidden md:flex items-center gap-4">

                    <!-- User Dropdown -->
                    <div class="relative">

                        <button
                            @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        >
                            <span class="text-ctext">
                                {{ user.name }}
                            </span>

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            v-if="open"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden z-50"
                        >

                            <Link
                                href="/profile"
                                class="block px-4 py-3 text-sm text-ctext hover:bg-gray-100 dark:hover:bg-gray-700"
                            >
                                Profile
                            </Link>

                            <Link
                                href="/logout"
                                method="post"
                                as="button"
                                class="block w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700"
                            >
                                Log Out
                            </Link>

                        </div>

                    </div>

                </div>

                <!-- Mobile Button -->
                <button
                    @click="open = !open"
                    class="md:hidden flex items-center"
                >
                    <svg
                        class="w-6 h-6 text-ctext"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            v-if="open"
            class="md:hidden border-t border-gray-200 dark:border-gray-700 p-4 space-y-2"
        >

            <Link
                href="/dashboard"
                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                Dashboard
            </Link>

            <Link
                href="/about"
                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                About
            </Link>

            <Link
                href="/profile"
                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                Profile
            </Link>

            <Link
                href="/logout"
                method="post"
                as="button"
                class="block w-full text-left px-3 py-2 rounded-lg text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700"
            >
                Logout
            </Link>

        </div>
    </nav>
</template>