<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { computed } from 'vue';
    import {
        summaryCards,
        netWorthTrend,
        expenseBreakdown,
        accounts,
        budgets,
        recentTransactions,
    } from '@/Data/dashboard';
    import { useThemeStore } from '@/Stores/theme';
    import { useDashboardCharts } from '@/Composables/useDashboardCharts';
    import { formatMoney } from '@/Utils/currency';
    import { ref } from 'vue';

    import SummaryCards from '@/Components/Dashboard/SummaryCards.vue';
    import NetWorthChart from '@/Components/Dashboard/NetWorthChart.vue';
    import ExpenseBreakdownChart from '@/Components/Dashboard/ExpenseBreakdownChart.vue';
    import AccountsChart from '@/Components/Dashboard/AccountsChart.vue';
    import BudgetUsageChart from '@/Components/Dashboard/BudgetUsageChart.vue';
    import RecentTransactionsTable from '@/Components/Dashboard/RecentTransactionsTable.vue';

    defineOptions({
        name: 'Dashboard',
        layout: AppLayout,
    });

    const themeStore = useThemeStore();

    const isDark = computed(() => themeStore.theme === "dark");
    const foreground = computed(() => (isDark.value ? "#ffffff" : "#1a1a1a"));
    const muted = computed(() => (isDark.value ? "#9ca3af" : "#6b7280"));
    const grid = computed(() => (isDark.value ? "#374151" : "#e5e7eb"));

    const netWorthPeriod = ref('1M');
    const expensePeriod = ref('1M');

    const {
        netWorthOptions,
        netWorthSeries,
        expenseBreakdownOptions,
        expenseBreakdownSeries,
        accountsOptions,
        accountsSeries,
        budgetUsageOptions,
        budgetUsageSeries,
    } = useDashboardCharts({
        isDark,
        foreground,
        muted,
        grid,
        netWorthTrend,
        netWorthPeriod,
        expenseBreakdown,
        expensePeriod,
        accounts,
        budgets,
    });
</script>

<template>
    <Head title="Dashboard" />

    <div class="mx-auto space-y-6 px-4 py-6 sm:px-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-muted">Overview</p>
                <h1 class="text-3xl font-bold text-ctext">Dashboard</h1>
            </div>

            <button
                type="button"
                class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-800"
                @click="themeStore.toggleTheme"
            >
                {{ isDark ? 'Light mode' : 'Dark mode' }}
            </button>
        </div>

        <SummaryCards :cards="summaryCards" />

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <NetWorthChart
                :options="netWorthOptions"
                :series="netWorthSeries"
                :period="netWorthPeriod"
                @update:period="netWorthPeriod = $event"
            />

            <ExpenseBreakdownChart
                :options="expenseBreakdownOptions"
                :series="expenseBreakdownSeries"
                :period="expensePeriod"
                @update:period="expensePeriod = $event"
            />
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
             <AccountsChart
                :options="accountsOptions"
                :series="accountsSeries"
            />

            <BudgetUsageChart
                :options="budgetUsageOptions"
                :series="budgetUsageSeries"
            />
        </div>

        <RecentTransactionsTable :transactions="recentTransactions" />
    </div>
</template>
