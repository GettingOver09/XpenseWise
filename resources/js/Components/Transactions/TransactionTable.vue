<script setup>
import { formatMoney } from "@/Utils/currency";
import { formatLongDate } from "@/Utils/dates";
import ArrowRise from "@/Components/Icons/ArrowRise.vue";
import PencilEdit02Icon from "@/Components/Icons/PencilEdit02Icon.vue";
import Delete02Icon from "@/Components/Icons/Delete02Icon.vue";
import { getTypeColor, getStatusClasses } from "@/Utils/transactionHelpers";

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

const emit = defineEmits(["edit"]);
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
                            Payee
                        </th>
                        <th
                            class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Category & Account
                        </th>
                        <th
                            class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Amount
                        </th>
                        <th
                            class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Running Balance
                        </th>
                        <th
                            class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Status
                        </th>

                        <th
                            class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-muted"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Loading State -->
                    <tr v-if="loading">
                        <td
                            colspan="7"
                            class="px-5 py-8 text-center text-muted"
                        >
                            Loading transactions...
                        </td>
                    </tr>

                    <!-- Empty State -->
                    <tr v-else-if="transactions.length === 0">
                        <td
                            colspan="7"
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
                            {{ formatLongDate(transaction.transaction_date) }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="font-medium text-ctext">
                                {{ transaction.payee }}
                            </div>

                            <div class="text-xs capitalize text-muted">
                                {{ transaction.type }}
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <span>{{ transaction.category?.icon }}</span>
                                <span>{{ transaction.category?.name }}</span>
                            </div>

                            <div
                                class="mt-1 flex items-center gap-2 text-xs text-muted"
                            >
                                <span>{{ transaction.account?.icon }}</span>
                                <span>{{ transaction.account?.name }}</span>
                            </div>
                        </td>
                        <td
                            class="px-5 py-4 text-right text-sm font-semibold"
                            :class="getTypeColor(transaction.type)"
                        >
                            <div class="flex items-center justify-end gap-2">
                                <ArrowRise
                                    v-if="transaction.type === 'income'"
                                    class="h-4 w-4"
                                />

                                <ArrowRise
                                    v-else-if="transaction.type === 'expense'"
                                    class="h-4 w-4"
                                    :flipped="true"
                                />

                                <span v-else>⇄</span>

                                {{ formatMoney(transaction.amount) }}
                            </div>
                        </td>
                        <td
                            class="whitespace-nowrap px-5 py-4 text-right text-sm text-muted"
                        >
                            {{ formatMoney(transaction.running_balance) }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span
                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold"
                                :class="getStatusClasses(transaction.status)"
                            >
                                {{
                                    transaction.status === "reviewed"
                                        ? "Reviewed"
                                        : "To Review"
                                }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    type="button"
                                    class="rounded-md p-2 text-slate-500 transition hover:bg-gray-100 hover:text-blue-600 dark:hover:bg-gray-800"
                                    title="Edit Transaction"
                                    @click="emit('edit', transaction)"
                                >
                                    <PencilEdit02Icon :size="18" />
                                </button>

                                <button
                                    type="button"
                                    class="rounded-md p-2 text-slate-500 transition hover:bg-gray-100 hover:text-red-600 dark:hover:bg-gray-800"
                                    title="Delete Transaction"
                                >
                                    <Delete02Icon :size="18" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
