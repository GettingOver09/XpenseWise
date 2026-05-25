<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({
    layout: AppLayout,
});
</script>

<template>
    <Head title="About" />

    <div class="mx-auto space-y-8">

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
        <div class="bg-background border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-ctext mb-6">
                Our Mission
            </h2>

            <p class="text-muted leading-relaxed text-[17px]">
                We're dedicated to helping individuals and families take control of their finances with a simple, powerful, and beautiful expense tracker.
            </p>

            <button
                class="mt-8 inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition"
            >
                Learn More
            </button>
        </div>

        <!-- Footer Navigation -->
        <div class="pt-4">
            <Link
                href="/dashboard"
                class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium"
            >
                ← Back to Dashboard
            </Link>
        </div>

    </div>
</template>