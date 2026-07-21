<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
// import { transactions } from "@/Data/transactions";

import { useTransactions } from "@/Composables/useTransactions";
import { useThemeStore } from "@/Stores/theme";
import { formatMoney } from "@/Utils/currency";

import TransactionFilters from "@/Components/Transactions/TransactionFilters.vue";
import TransactionTable from "@/Components/Transactions/TransactionTable.vue";
import TransactionActivity from "@/Components/Transactions/TransactionActivity.vue";
import CreateTransactionModal from "@/Components/Transactions/CreateTransactionModal.vue";

defineOptions({
    name: "Transactions",
    layout: AppLayout,
});

const themeStore = useThemeStore();

// Props from Laravel Controller
const { props } = usePage();
const transactionsData = computed(() => props.transactions?.data || []);

console.log("Transactions Data:", transactionsData.value);

const isDark = computed(() => themeStore.theme === "dark");
const transactionsPeriod = ref("last_month");
const transactionTypeIndex = ref(0);
const transactionViewIndex = ref(0);
const selectedAccount = ref("All accounts");
const searchQuery = ref("");
const selectedCategories = ref([]);
const selectedDateFrom = ref("");
const selectedDateTo = ref("");

const {
    periodOptions,
    transactionTypes,
    viewTabs,
    accounts,
    categories,
    selectedType,
    selectedPeriodLabel,
    filteredTransactions,
} = useTransactions({
    transactions: transactionsData,
    transactionsPeriod,
    transactionTypeIndex,
    selectedAccount,
    searchQuery,
    selectedCategories,
    selectedDateFrom,
    selectedDateTo,
});
</script>

<template>
    <Head title="Transactions" />

    <div class="mx-auto space-y-6 px-4 py-6 sm:px-6">
        <!-- Header -->
        <div
            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm font-medium text-muted">Manage</p>
                <h1 class="text-3xl font-bold text-ctext">Transactions</h1>
            </div>

            <button
                type="button"
                class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-800"
                @click="themeStore.toggleTheme"
            >
                {{ isDark ? "Light mode" : "Dark mode" }}
            </button>
        </div>
        <section
            class="flex flex-col gap-4 xl:flex-row xl:items-end xl:justify-between"
        >
            <!-- Filters -->
            <TransactionFilters
                v-model:period="transactionsPeriod"
                v-model:account="selectedAccount"
                v-model:search="searchQuery"
                v-model:selected-index="transactionTypeIndex"
                v-model:selected-categories="selectedCategories"
                v-model:from-date="selectedDateFrom"
                v-model:to-date="selectedDateTo"
                :period-options="periodOptions"
                :accounts="accounts"
                :types="transactionTypes"
                :categories="categories"
            />

            <CreateTransactionModal
                :accounts="accounts"
                :categories="categories"
                :types="transactionTypes"
            />
        </section>

        <!-- View Tabs -->
        <TabGroup
            :selected-index="transactionViewIndex"
            @change="transactionViewIndex = $event"
        >
            <div
                class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                <TabList
                    class="flex w-full space-x-1 rounded-xl bg-gray-100 p-1 sm:w-72 dark:bg-gray-800"
                >
                    <Tab
                        v-for="tab in viewTabs"
                        :key="tab"
                        v-slot="{ selected }"
                        as="template"
                    >
                        <button
                            :class="[
                                'w-full rounded-lg px-3 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-gray-900',
                                selected
                                    ? 'bg-background text-primary shadow-sm'
                                    : 'text-muted hover:bg-white/60 hover:text-ctext dark:hover:bg-gray-700',
                            ]"
                        >
                            {{ tab }} View
                        </button>
                    </Tab>
                </TabList>

                <div class="flex flex-col sm:items-end">
                    <h2 class="text-lg font-semibold text-ctext">
                        {{ selectedType }} Transactions
                    </h2>
                    <p class="text-sm text-muted">
                        {{ filteredTransactions.length }} results for
                        {{ selectedPeriodLabel }}
                    </p>
                </div>
            </div>

            <TabPanels class="mt-4">
                <TabPanel>
                    <TransactionTable :transactions="filteredTransactions" />
                </TabPanel>

                <TabPanel>
                    <TransactionActivity :transactions="filteredTransactions" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>
