<script setup>
defineProps({
    options: Object,
    series: Array,
});
</script>

<template>
    <section
        class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700 xl:col-span-2"
    >
        <div class="mb-4 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-ctext">
                    Net Worth Trend
                </h2>

                <p class="text-sm text-muted">
                    Last 12 months
                </p>
            </div>

            <p
                class="text-sm font-semibold text-emerald-600 dark:text-emerald-400"
            >
                +69.3%
            </p>
        </div>

        <apexchart
            type="area"
            height="320"
            :options="options"
            :series="series"
        />
    </section>
</template>