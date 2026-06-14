<script setup>
    import { computed } from 'vue';
    import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue';

    const props =defineProps({
        options: Object,
        series: Array,
        period: {
            type: String,
            required: true,
        },
    });

    const periods = [
        { value: '1D', label: '1D' },
        { value: '1W', label: '1W' },
        { value: '1M', label: '1M' },
        { value: '6M', label: '6M' },
        { value: '1Y', label: '1Y' },
    ];

    const emit = defineEmits([
        'update:period',
    ]);
    
    const selectedPeriod = computed({
        get() {
            return (
                periods.find(
                    item => item.value === props.period
                ) ?? periods[2]
            );
        },

        set(value) {
            emit(
                'update:period',
                value.value
            );
        },
    });
</script>

<template>
    <section
        class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
    >
        <div class="mb-4 flex flex-row justify-between">
            <div class="flex flex-col">
                <h2 class="text-lg font-semibold text-ctext">
                    Expense Breakdown
                </h2>
                
                <p class="text-sm text-muted">
                    Current month
                </p>
            </div>

             <!-- 3. The New Headless UI Dropdown replacing your <select> element -->
            <Listbox v-model="selectedPeriod" as="div" class="relative inline-block text-left">
                
                <!-- This button looks exactly like a clean, thin form element -->
                <ListboxButton
                    class="inline-flex items-center gap-x-1 rounded-md bg-background h-8 px-2 text-sm border border-gray-200 text-ctext dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none"
                >
                    <span>{{ selectedPeriod.label }}</span>
                    <!-- Down arrow icon -->
                    <svg class="h-3 w-3 text-muted" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </ListboxButton>

                <!-- This is the actual dropdown popup container that you can fully design -->
                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="absolute right-0 z-50 mt-1 max-h-60 w-32 overflow-auto rounded-md bg-background py-1 text-sm shadow-lg border border-gray-200 dark:border-gray-700 focus:outline-none"
                    >
                        <ListboxOption
                            v-for="item in periods"
                            :key="item.value"
                            :value="item"
                            v-slot="{ active, selected }"
                            as="template"
                        >
                            <li
                                :class="[
                                    active ? 'bg-gray-100 dark:bg-gray-800 text-ctext' : 'text-muted',
                                    'relative cursor-pointer select-none py-1.5 px-3 transition-colors'
                                ]"
                            >
                                <span :class="[selected ? 'font-semibold text-primary' : 'font-normal', 'block truncate']">
                                    {{ item.label }}
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </Listbox>
        </div>

        <apexchart
            type="donut"
            height="320"
            :options="options"
            :series="series"
        />
    </section>
</template>