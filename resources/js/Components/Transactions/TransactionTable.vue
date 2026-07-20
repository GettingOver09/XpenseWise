<script setup>
import { formatMoney } from "@/Utils/currency";
import { formatLongDate } from "@/Utils/dates";

defineProps({
    transactions: {
        type: Array,
        required: true,
        default: () => [],
    },
    loading: {
        type: Boolean,
        default: false,
    },
});

const getTypeColor = (type) => {
    if (type === "income") return "text-emerald-600 dark:text-emerald-400";
    if (type === "transfer") return "text-slate-600 dark:text-slate-400";
    return "text-rose-600 dark:text-rose-400";
};
</script>

<template>
    <section
        class="overflow-hidden rounded-lg border border-gray-200 bg-background shadow-sm dark:border-gray-700"
    >
        <div class="overflow-x-auto">
            <table
                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
            >
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Date
                        </th>
                        <th
                            class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Merchant / Payee
                        </th>
                        <th
                            class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Category
                        </th>
                        <th
                            class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Account
                        </th>
                        <th
                            class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Amount
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Loading State -->
                    <tr v-if="loading">
                        <td
                            colspan="5"
                            class="px-5 py-8 text-center text-muted"
                        >
                            Loading transactions...
                        </td>
                    </tr>

                    <!-- Empty State -->
                    <tr v-else-if="transactions.length === 0">
                        <td
                            colspan="5"
                            class="px-5 py-12 text-center text-muted"
                        >
                            No transactions found.
                        </td>
                    </tr>

                    <!-- Transaction Rows -->
                    <tr
                        v-else
                        v-for="transaction in transactions"
                        :key="transaction.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors"
                    >
                        <td
                            class="whitespace-nowrap px-5 py-4 text-sm text-muted"
                        >
                            {{ formatLongDate(transaction.date) }}
                        </td>
                        <td
                            class="whitespace-nowrap px-5 py-4 text-sm font-medium text-ctext"
                        >
                            {{ transaction.payee }}
                        </td>
                        <td
                            class="whitespace-nowrap px-5 py-4 text-sm text-muted"
                        >
                            {{
                                transaction.category?.name ||
                                transaction.category
                            }}
                        </td>
                        <td
                            class="whitespace-nowrap px-5 py-4 text-sm text-muted"
                        >
                            {{
                                transaction.account?.name || transaction.account
                            }}
                        </td>
                        <td
                            class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold"
                            :class="getTypeColor(transaction.type)"
                        >
                            {{ formatMoney(transaction.amount) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
