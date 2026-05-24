<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout,
});
</script>

<template>
    <Head title="About" />

    <div class="mx-auto space-y-6">

        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold text-ctext">
                About Us
            </h1>

            <p class="text-muted mt-1">
                Learn more about XpenseWise and our mission.
            </p>
        </div>

        <!-- Main Content -->
        <div
            class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6"
        >
            <h2 class="text-xl font-semibold text-ctext mb-4">
                Our Mission
            </h2>

            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                We're dedicated to providing the best experience for our users.
            </p>

            <button
                class="mt-6 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:opacity-90 transition"
            >
                Learn More
            </button>
        </div>

        <!-- Footer Navigation -->
        <div>
            <Link
                href="/dashboard"
                class="text-primary hover:underline"
            >
                Back to Dashboard
            </Link>
        </div>

    </div>
</template>