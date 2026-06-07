<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useThemeStore } from '@/stores/theme';

const themeStore = useThemeStore();

defineOptions({
    name: 'Dashboard',
    layout: AppLayout,
});

const money = new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    maximumFractionDigits: 0,
});

const summaryCards = [
    {
        label: 'Total Balance',
        value: money.format(48250),
        helper: '+8.4% from last month',
        tone: 'text-emerald-600 dark:text-emerald-400',
    },
    {
        label: 'This Month Income',
        value: money.format(32800),
        helper: '3 income entries',
        tone: 'text-sky-600 dark:text-sky-400',
    },
    {
        label: 'This Month Expenses',
        value: money.format(12480),
        helper: '42% of income spent',
        tone: 'text-rose-600 dark:text-rose-400',
    },
];

const netWorthTrend = [
    28500, 30250, 31800, 33600, 35150, 37700, 39400, 42100, 43800, 45200, 46850,
    48250,
];

const expenseBreakdown = [
    { label: 'Food', value: 4200 },
    { label: 'Bills', value: 3100 },
    { label: 'Transport', value: 1850 },
    { label: 'Shopping', value: 2100 },
    { label: 'Subscriptions', value: 1230 },
];

const accounts = [
    { name: 'BDO Savings', balance: 22800 },
    { name: 'GCash', balance: 8100 },
    { name: 'Maya Wallet', balance: 6350 },
    { name: 'Emergency Fund', balance: 11000 },
];

const budgets = [
    { name: 'Groceries', used: 6800, limit: 10000 },
    { name: 'Dining Out', used: 3600, limit: 5000 },
    { name: 'Transport', used: 1900, limit: 3000 },
    { name: 'Entertainment', used: 2600, limit: 4000 },
];

const recentTransactions = [
    {
        date: 'Jun 8',
        merchant: 'Salary',
        category: 'Income',
        account: 'BDO Savings',
        amount: 28000,
        type: 'income',
    },
    {
        date: 'Jun 7',
        merchant: 'Meralco',
        category: 'Bills',
        account: 'BDO Savings',
        amount: -2450,
        type: 'expense',
    },
    {
        date: 'Jun 6',
        merchant: 'Grab',
        category: 'Transport',
        account: 'GCash',
        amount: -320,
        type: 'expense',
    },
    {
        date: 'Jun 5',
        merchant: 'Landers',
        category: 'Groceries',
        account: 'Maya Wallet',
        amount: -3150,
        type: 'expense',
    },
    {
        date: 'Jun 4',
        merchant: 'Freelance Project',
        category: 'Income',
        account: 'BDO Savings',
        amount: 4800,
        type: 'income',
    },
];

const isDark = computed(() => themeStore.theme === 'dark');
const foreground = computed(() => (isDark.value ? '#ffffff' : '#1a1a1a'));
const muted = computed(() => (isDark.value ? '#9ca3af' : '#6b7280'));
const grid = computed(() => (isDark.value ? '#374151' : '#e5e7eb'));

const chartBase = computed(() => ({
    chart: {
        toolbar: { show: false },
        zoom: { enabled: false },
        foreColor: muted.value,
        fontFamily: 'Figtree, ui-sans-serif, system-ui, sans-serif',
    },
    dataLabels: { enabled: false },
    legend: {
        labels: { colors: muted.value },
    },
    tooltip: {
        theme: isDark.value ? 'dark' : 'light',
        y: {
            formatter: (value) => money.format(value),
        },
    },
}));

const netWorthOptions = computed(() => ({
    ...chartBase.value,
    chart: {
        ...chartBase.value.chart,
        sparkline: { enabled: false },
    },
    colors: ['#10b981'],
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.34,
            opacityTo: 0.04,
            stops: [0, 90, 100],
        },
    },
    grid: {
        borderColor: grid.value,
        strokeDashArray: 4,
    },
    stroke: {
        curve: 'smooth',
        width: 3,
    },
    xaxis: {
        categories: [
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
        ],
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: muted.value } },
    },
    yaxis: {
        labels: {
            formatter: (value) => `${Math.round(value / 1000)}k`,
            style: { colors: muted.value },
        },
    },
}));

const netWorthSeries = computed(() => [
    {
        name: 'Net Worth',
        data: netWorthTrend,
    },
]);

const expenseBreakdownOptions = computed(() => ({
    ...chartBase.value,
    labels: expenseBreakdown.map((item) => item.label),
    colors: ['#ef4444', '#f59e0b', '#06b6d4', '#8b5cf6', '#64748b'],
    plotOptions: {
        pie: {
            donut: {
                size: '68%',
                labels: {
                    show: true,
                    name: {
                        color: muted.value,
                    },
                    value: {
                        color: foreground.value,
                        formatter: (value) => money.format(value),
                    },
                    total: {
                        show: true,
                        label: 'Expenses',
                        color: muted.value,
                        formatter: () =>
                            money.format(
                                expenseBreakdown.reduce(
                                    (total, item) => total + item.value,
                                    0,
                                ),
                            ),
                    },
                },
            },
        },
    },
    stroke: {
        colors: [isDark.value ? '#1a202c' : '#ffffff'],
    },
}));

const expenseBreakdownSeries = computed(() =>
    expenseBreakdown.map((item) => item.value),
);

const accountsOptions = computed(() => ({
    ...chartBase.value,
    colors: ['#4f46e5'],
    grid: {
        borderColor: grid.value,
        strokeDashArray: 4,
    },
    plotOptions: {
        bar: {
            horizontal: true,
            barHeight: '54%',
            borderRadius: 5,
            distributed: true,
        },
    },
    xaxis: {
        categories: accounts.map((item) => item.name),
        labels: {
            formatter: (value) => `${Math.round(value / 1000)}k`,
            style: { colors: muted.value },
        },
    },
    yaxis: {
        labels: {
            style: { colors: muted.value },
        },
    },
    legend: { show: false },
}));

const accountsSeries = computed(() => [
    {
        name: 'Balance',
        data: accounts.map((item) => item.balance),
    },
]);

const budgetUsageOptions = computed(() => ({
    ...chartBase.value,
    colors: ['#f59e0b'],
    grid: {
        borderColor: grid.value,
        strokeDashArray: 4,
    },
    plotOptions: {
        bar: {
            horizontal: true,
            barHeight: '54%',
            borderRadius: 5,
        },
    },
    xaxis: {
        categories: budgets.map((item) => item.name),
        max: 100,
        labels: {
            formatter: (value) => `${value}%`,
            style: { colors: muted.value },
        },
    },
    yaxis: {
        labels: {
            style: { colors: muted.value },
        },
    },
    tooltip: {
        theme: isDark.value ? 'dark' : 'light',
        y: {
            formatter: (value, context) => {
                const budget = budgets[context.dataPointIndex];

                return `${value}% of ${money.format(budget.limit)}`;
            },
        },
    },
}));

const budgetUsageSeries = computed(() => [
    {
        name: 'Used',
        data: budgets.map((item) => Math.round((item.used / item.limit) * 100)),
    },
]);
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

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <section
                v-for="card in summaryCards"
                :key="card.label"
                class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
            >
                <p class="text-sm font-medium text-muted">{{ card.label }}</p>
                <p class="mt-3 text-3xl font-bold" :class="card.tone">
                    {{ card.value }}
                </p>
                <p class="mt-2 text-sm text-muted">{{ card.helper }}</p>
            </section>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <section
                class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700 xl:col-span-2"
            >
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-ctext">
                            Net Worth Trend
                        </h2>
                        <p class="text-sm text-muted">Last 12 months</p>
                    </div>
                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                        +69.3%
                    </p>
                </div>

                <apexchart
                    type="area"
                    height="320"
                    :options="netWorthOptions"
                    :series="netWorthSeries"
                />
            </section>

            <section
                class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
            >
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-ctext">
                        Expense Breakdown
                    </h2>
                    <p class="text-sm text-muted">Current month</p>
                </div>

                <apexchart
                    type="donut"
                    height="320"
                    :options="expenseBreakdownOptions"
                    :series="expenseBreakdownSeries"
                />
            </section>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <section
                class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
            >
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-ctext">Accounts</h2>
                    <p class="text-sm text-muted">Available balances</p>
                </div>

                <apexchart
                    type="bar"
                    height="300"
                    :options="accountsOptions"
                    :series="accountsSeries"
                />
            </section>

            <section
                class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
            >
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-ctext">
                        Budget Usage
                    </h2>
                    <p class="text-sm text-muted">Spent versus limit</p>
                </div>

                <apexchart
                    type="bar"
                    height="300"
                    :options="budgetUsageOptions"
                    :series="budgetUsageSeries"
                />
            </section>
        </div>

        <section
            class="overflow-hidden rounded-lg border border-gray-200 bg-background shadow-sm dark:border-gray-700"
        >
            <div class="border-b border-gray-200 p-5 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-ctext">
                    Recent Transactions
                </h2>
                <p class="text-sm text-muted">Latest account activity</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted">
                                Date
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted">
                                Merchant
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted">
                                Category
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted">
                                Account
                            </th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-muted">
                                Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr
                            v-for="transaction in recentTransactions"
                            :key="`${transaction.date}-${transaction.merchant}`"
                            class="hover:bg-gray-50 dark:hover:bg-gray-900/30"
                        >
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-muted">
                                {{ transaction.date }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-ctext">
                                {{ transaction.merchant }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-muted">
                                {{ transaction.category }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-muted">
                                {{ transaction.account }}
                            </td>
                            <td
                                class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold"
                                :class="
                                    transaction.type === 'income'
                                        ? 'text-emerald-600 dark:text-emerald-400'
                                        : 'text-rose-600 dark:text-rose-400'
                                "
                            >
                                {{ money.format(transaction.amount) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>
