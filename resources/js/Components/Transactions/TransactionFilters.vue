<script setup>
import { computed, ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
    Tab,
    TabGroup,
    TabList,
} from "@headlessui/vue";
import PreferenceHorizontalIcon from "@/Components/Icons/PreferenceHorizontalIcon.vue";

const props = defineProps({
    periodOptions: {
        type: Array,
        required: true,
    },

    accounts: {
        type: Array,
        required: true,
    },

    types: {
        type: Array,
        required: true,
    },

    categories: {
        type: Array,
        required: true,
    },
});

const period = defineModel("period");
const account = defineModel("account");
const search = defineModel("search");
const selectedIndex = defineModel("selectedIndex");
const selectedCategories = defineModel("selectedCategories");
const fromDate = defineModel("fromDate");
const toDate = defineModel("toDate");

const showFilterModal = ref(false);

const selectedPeriodLabel = computed(() => {
    return props.periodOptions.find((option) => option.value === period.value)
        ?.label;
});
</script>

<template>
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-[1fr_auto]">
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

        <div class="flex items-end justify-start lg:justify-end">
            <button
                type="button"
                @click="showFilterModal = true"
                class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext shadow-sm transition hover:border-primary hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800"
            >
                <!-- Insert the custom icon component here -->
                <PreferenceHorizontalIcon size="20" class="mr-2" />
                Filters
            </button>
        </div>

        <TransitionRoot as="template" :show="showFilterModal">
            <Dialog
                as="div"
                class="relative z-50"
                @close="showFilterModal = false"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm"
                    />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-3xl transform overflow-hidden rounded-3xl border border-gray-200 bg-background p-6 text-left shadow-xl transition-all dark:border-gray-700"
                            >
                                <div
                                    class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between"
                                >
                                    <div>
                                        <DialogTitle
                                            class="text-lg font-semibold text-ctext"
                                        >
                                            Filters
                                        </DialogTitle>
                                        <p class="mt-1 text-sm text-muted">
                                            Refine your transaction list using
                                            the period, date range, account,
                                            type, and category filters.
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6 grid gap-4 lg:grid-cols-2">
                                    <div>
                                        <label
                                            class="text-sm font-semibold text-ctext"
                                            >Period</label
                                        >
                                        <Listbox v-model="period">
                                            <div class="relative mt-2">
                                                <ListboxButton
                                                    class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-left text-sm text-ctext shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800"
                                                >
                                                    {{ selectedPeriodLabel }}
                                                </ListboxButton>

                                                <ListboxOptions
                                                    class="absolute z-20 mt-2 max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-background py-1 text-sm shadow-lg focus:outline-none dark:border-gray-700"
                                                >
                                                    <ListboxOption
                                                        v-for="option in periodOptions"
                                                        :key="option.value"
                                                        v-slot="{
                                                            active,
                                                            selected,
                                                        }"
                                                        :value="option.value"
                                                        as="template"
                                                    >
                                                        <li
                                                            :class="[
                                                                'cursor-pointer px-4 py-2',
                                                                active
                                                                    ? 'bg-gray-100 text-ctext dark:bg-gray-800'
                                                                    : 'text-muted',
                                                                selected
                                                                    ? 'font-semibold text-primary'
                                                                    : '',
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
                                        <label
                                            class="text-sm font-semibold text-ctext"
                                            >Account</label
                                        >
                                        <Listbox v-model="account">
                                            <div class="relative mt-2">
                                                <ListboxButton
                                                    class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-left text-sm text-ctext shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800"
                                                >
                                                    {{ account }}
                                                </ListboxButton>

                                                <ListboxOptions
                                                    class="absolute z-20 mt-2 max-h-64 w-full overflow-auto rounded-lg border border-gray-200 bg-background py-1 text-sm shadow-lg focus:outline-none dark:border-gray-700"
                                                >
                                                    <ListboxOption
                                                        v-for="option in accounts"
                                                        :key="option"
                                                        v-slot="{
                                                            active,
                                                            selected,
                                                        }"
                                                        :value="option"
                                                        as="template"
                                                    >
                                                        <li
                                                            :class="[
                                                                'cursor-pointer px-4 py-2',
                                                                active
                                                                    ? 'bg-gray-100 text-ctext dark:bg-gray-800'
                                                                    : 'text-muted',
                                                                selected
                                                                    ? 'font-semibold text-primary'
                                                                    : '',
                                                            ]"
                                                        >
                                                            {{ option }}
                                                        </li>
                                                    </ListboxOption>
                                                </ListboxOptions>
                                            </div>
                                        </Listbox>
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label
                                            class="text-sm font-semibold text-ctext"
                                            >Date Range</label
                                        >
                                        <div
                                            class="mt-3 grid gap-4 sm:grid-cols-2"
                                        >
                                            <div>
                                                <label
                                                    for="from-date"
                                                    class="text-xs font-semibold uppercase tracking-wide text-muted"
                                                >
                                                    From
                                                </label>
                                                <input
                                                    id="from-date"
                                                    type="date"
                                                    v-model="fromDate"
                                                    class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    for="to-date"
                                                    class="text-xs font-semibold uppercase tracking-wide text-muted"
                                                >
                                                    To
                                                </label>
                                                <input
                                                    id="to-date"
                                                    type="date"
                                                    v-model="toDate"
                                                    class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label
                                            class="text-sm font-semibold text-ctext"
                                            >Transaction Type</label
                                        >
                                        <TabGroup
                                            :selected-index="selectedIndex"
                                            @change="selectedIndex = $event"
                                            class="mt-2"
                                        >
                                            <TabList
                                                class="flex flex-wrap gap-2 rounded-xl bg-gray-100 p-1 dark:bg-gray-800"
                                            >
                                                <Tab
                                                    v-for="type in types"
                                                    :key="type"
                                                    v-slot="{ selected }"
                                                    as="template"
                                                >
                                                    <button
                                                        type="button"
                                                        :class="[
                                                            'rounded-lg px-3 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-gray-900',
                                                            selected
                                                                ? 'bg-background text-primary shadow-sm'
                                                                : 'text-muted hover:bg-white/60 hover:text-ctext dark:hover:bg-gray-700',
                                                        ]"
                                                    >
                                                        {{ type }}
                                                    </button>
                                                </Tab>
                                            </TabList>
                                        </TabGroup>
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label
                                            class="text-sm font-semibold text-ctext"
                                            >Categories</label
                                        >
                                        <div
                                            class="mt-3 grid gap-2 sm:grid-cols-2"
                                        >
                                            <label
                                                v-for="category in categories"
                                                :key="category"
                                                class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-background px-3 py-2 text-sm text-ctext transition hover:border-primary hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-gray-800"
                                            >
                                                <input
                                                    type="checkbox"
                                                    :value="category"
                                                    v-model="selectedCategories"
                                                    class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                                                />
                                                {{ category }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end"
                                >
                                    <button
                                        type="button"
                                        class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 sm:w-auto"
                                        @click="showFilterModal = false"
                                    >
                                        Close
                                    </button>

                                    <button
                                        type="button"
                                        class="w-full rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary/90 sm:w-auto"
                                        @click="showFilterModal = false"
                                    >
                                        Apply filters
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
