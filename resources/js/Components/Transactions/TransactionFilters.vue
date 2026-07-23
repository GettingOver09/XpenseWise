<script setup>
import { computed, ref, watch } from "vue";
import Modal from "@/Components/Overlays/Modal.vue";
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

const selectedType = computed(() => props.types[selectedIndex.value] ?? "");

const showCustomRange = computed(() => period.value === "custom");

const categoryFilterVisible = computed(
    () => selectedType.value.toLowerCase() !== "transfer",
);

const defaultPeriod =
    props.periodOptions.find((option) => option.value === "last_month")
        ?.value ??
    props.periodOptions[0]?.value ??
    "today";
const defaultAccount = props.accounts.includes("All accounts")
    ? "All accounts"
    : (props.accounts[0] ?? "");

const resetFilters = () => {
    period.value = defaultPeriod;
    account.value = defaultAccount;
    search.value = "";
    selectedIndex.value = 0;
    selectedCategories.value = [];
    fromDate.value = "";
    toDate.value = "";
};

watch([selectedIndex, () => props.categories], () => {
    if (selectedType.value.toLowerCase() === "transfer") {
        selectedCategories.value = [];
        return;
    }

    selectedCategories.value = selectedCategories.value.filter((item) =>
        props.categories.includes(item),
    );
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
                placeholder="Merchant, category, description"
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

        <Modal
            :show="showFilterModal"
            title="Filters"
            description="Refine the transaction list with period, account, type, and category controls."
            @close="showFilterModal = false"
        >
            <div class="mt-6 grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-ctext"
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
                                    v-for="option in props.periodOptions"
                                    :key="option.value"
                                    v-slot="{ active, selected }"
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
                    <label class="text-sm font-semibold text-ctext"
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
                                    v-slot="{ active, selected }"
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

                <!-- Custom Date Range -->
                <div v-if="showCustomRange" class="lg:col-span-2">
                    <div class="mt-3 grid gap-4 sm:grid-cols-2">
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

                <!-- Transaction Types -->
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold text-ctext"
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
                                        'flex-1 rounded-lg px-3 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-gray-900',
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

                <div v-if="categoryFilterVisible" class="lg:col-span-2">
                    <label class="text-sm font-semibold text-ctext"
                        >Categories</label
                    >
                    <div class="mt-3 grid gap-2 sm:grid-cols-2">
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

            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    @click="resetFilters"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext transition hover:border-primary hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800"
                >
                    Clear All Filters
                </button>

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
        </Modal>
    </div>
</template>
