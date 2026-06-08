<script setup>
import { formatMoney } from '@/Utils/currency';

defineProps({
    transactions: {
        type: Array,
        required: true,
    },
});
</script>

<template>
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
                            v-for="transaction in transactions"
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
                                {{ formatMoney(transaction.amount) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
</template>