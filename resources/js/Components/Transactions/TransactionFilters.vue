<script setup>
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
    TabList,
    Tab,
    TabGroup,
} from '@headlessui/vue';
import { computed } from 'vue';

const period = defineModel('period');
const account = defineModel('account');
const search = defineModel('search');

const props = defineProps({
    periodOptions: {
        type: Array,
        required: true,
    },

    accounts: {
        type: Array,
        required: true,
    },
});

const selectedPeriodLabel = computed(() => {
    return props.periodOptions.find(
        (option) => option.value === period.value,
    )?.label;
});
</script>

<template>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <label class="text-sm font-semibold text-ctext">Period</label>

                <Listbox v-model="period">
                    <div class="relative mt-2">
                        <ListboxButton class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-left text-sm text-ctext shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                            {{ selectedPeriodLabel }}
                        </ListboxButton>

                        <ListboxOptions class="absolute z-20 mt-2 max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-background py-1 text-sm shadow-lg focus:outline-none dark:border-gray-700">
                            <ListboxOption
                                v-for="option in periodOptions"
                                :key="option.value"
                                v-slot="{ active, selected }"
                                :value="option.value"
                                as="template"
                            >
                                <li
                                    :class="[
                                        'cursor-pointer px-4 py-2',
                                        active ? 'bg-gray-100 text-ctext dark:bg-gray-800' : 'text-muted',
                                        selected ? 'font-semibold text-primary' : '',
                                    ]"
                                >
                                    {{ option.label }}
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </div>
                </Listbox>
            </div>

            <div>
                <label class="text-sm font-semibold text-ctext">Account</label>

                <Listbox v-model="account">
                    <div class="relative mt-2">
                        <ListboxButton class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-left text-sm text-ctext shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                            {{ account }}
                        </ListboxButton>

                        <ListboxOptions class="absolute z-20 mt-2 max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-background py-1 text-sm shadow-lg focus:outline-none dark:border-gray-700">
                            <ListboxOption
                                v-for="account in accounts"
                                :key="account"
                                v-slot="{ active, selected }"
                                :value="account"
                                as="template"
                            >
                                <li
                                    :class="[
                                        'cursor-pointer px-4 py-2',
                                        active ? 'bg-gray-100 text-ctext dark:bg-gray-800' : 'text-muted',
                                        selected ? 'font-semibold text-primary' : '',
                                    ]"
                                >
                                    {{ account }}
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </div>
                </Listbox>
            </div>

            <div>
                <label
                    for="transaction-search"
                    class="text-sm font-semibold text-ctext"
                >
                    Search
                </label>

                <input
                    id="transaction-search"
                    v-model="search"
                    type="search"
                    class="mt-2 w-full rounded-lg border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm placeholder:text-muted focus:border-primary focus:ring-primary dark:border-gray-700"
                    placeholder="Merchant, category, note"
                />
            </div>           
        </div>
  
</template>