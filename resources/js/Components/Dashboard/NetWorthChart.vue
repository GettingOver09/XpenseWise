<script setup>
import { computed } from 'vue';

defineProps({
    options: Object,
    series: Array,
    period: String,
});

const periods = [
    '1D',
    '1W',
    '1M',
    '6M',
    '1Y',
];

const emit = defineEmits([
    'update:period',
]);
</script>

<template>
    <section
        class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700 xl:col-span-2"
    >
        
        <div class="mb-4 flex items-center justify-between gap-4">

            <div>
                <div class="flex items-center gap-6">
                    <h2 class="text-lg font-semibold text-ctext">
                        Net Worth Trend
                    </h2>
                
                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                        +69.3%
                    </p>
                </div>
            

                <p class="text-sm text-muted">
                    Last 12 months
                </p>
            </div>

            <div class="flex gap-2">
                <button
                    v-for="item in periods"
                    :key="item"
                    @click="emit('update:period', item)"
                    :class="[
                        'rounded-md px-3 py-1 text-xs font-medium',
                        period === item
                            ? 'bg-primary text-white'
                            : 'bg-gray-100 dark:bg-gray-800'
                    ]"
                >
                    {{ item }}
                </button>
            </div>
        </div>

        <apexchart
            type="area"
            height="320"

            :options="options"
            :series="series"
        />
    </section>
</template>