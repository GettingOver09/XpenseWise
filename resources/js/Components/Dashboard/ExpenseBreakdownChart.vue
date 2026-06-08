<script setup>
defineProps({
    options: Object,
    series: Array,
});
</script>

<template>
    <section
        class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
    >
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-ctext">
                Expense Breakdown
            </h2>

            <p class="text-sm text-muted">
                Current month
            </p>
        </div>

        <apexchart
            type="donut"
            height="320"
            :options="options"
            :series="series"
        />
    </section>
</template>