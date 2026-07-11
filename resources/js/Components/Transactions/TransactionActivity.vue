<script setup>
import { formatMoney } from "@/Utils/currency";

defineProps({
    transactions: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <section
        class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
    >
        <ol class="space-y-4">
            <li
                v-for="transaction in transactions"
                :key="transaction.id"
                class="flex gap-4 rounded-lg border border-gray-200 p-4 dark:border-gray-700"
            >
                <div
                    class="mt-1 h-3 w-3 shrink-0 rounded-full"
                    :class="
                        transaction.type === 'income'
                            ? 'bg-emerald-500'
                            : 'bg-rose-500'
                    "
                />

                <div class="min-w-0 flex-1">
                    <div
                        class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <p class="font-semibold text-ctext">
                            {{ transaction.merchant }}
                        </p>

                        <p
                            class="text-sm font-semibold"
                            :class="
                                transaction.type === 'income'
                                    ? 'text-emerald-600 dark:text-emerald-400'
                                    : 'text-rose-600 dark:text-rose-400'
                            "
                        >
                            {{ formatMoney(transaction.amount) }}
                        </p>
                    </div>

                    <p class="mt-1 text-sm text-muted">
                        {{ transaction.date }} · {{ transaction.category }} ·
                        {{ transaction.account }}
                    </p>

                    <p class="mt-2 text-sm text-ctext">
                        {{ transaction.note }}
                    </p>
                </div>
            </li>
        </ol>
    </section>
</template>
