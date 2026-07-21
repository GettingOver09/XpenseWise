<script setup>
import { computed } from "vue";
import { formatMoney } from "@/Utils/currency";
import { formatLongDate } from "@/Utils/dates";
import {
    getTypeColor,
    getStatusClasses,
    getTypeLabel,
} from "@/Utils/transactionHelpers";

const props = defineProps({
    transaction: {
        type: Object,
        required: true,
    },
});

const amountClass = computed(() => getTypeColor(props.transaction.type));
const typeLabel = computed(() => getTypeLabel(props.transaction.type));
const formattedAmount = computed(() => formatMoney(props.transaction.amount));
const formattedDate = computed(() =>
    formatLongDate(props.transaction.transaction_date),
);
</script>

<template>
    <article
        class="flex items-stretch overflow-hidden gap-4 rounded-lg border border-gray-200 bg-background dark:border-gray-700"
    >
        <!-- Left: Icon (placeholder) -->
        <div
            class="flex w-20 items-center justify-center bg-gray-100 text-lg dark:bg-gray-800 flex-shrink-0"
        >
            <span aria-hidden class="text-4xl">
                {{ transaction.category?.icon }}
            </span>
        </div>

        <!-- Middle: Info -->
        <!-- REMOVED: w-full. KEPT: flex-1 to occupy remaining space safely -->
        <div class="flex-1 min-w-0 flex items-center py-3">
            <!-- CHANGED: Made this container fill the available flex space -->
            <div class="w-full">
                <div class="min-w-0">
                    <p class="flex items-center gap-2 font-semibold text-ctext">
                        <!-- Added truncate explicitly here to guard layout text -->
                        <span class="truncate">{{ transaction.payee }}</span>
                        <span class="text-muted flex-shrink-0">•</span>
                        <span class="text-sm text-muted flex-shrink-0">{{
                            typeLabel
                        }}</span>
                    </p>
                    <p class="mt-1 truncate text-sm text-muted">
                        {{ transaction.description }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <span
                            v-if="transaction.category"
                            class="rounded-full border border-gray-200 bg-background px-2 py-1 text-xs font-medium text-ctext dark:border-gray-700"
                            >{{ transaction.category?.name }}</span
                        >

                        <span
                            v-if="transaction.account"
                            class="rounded-full border border-gray-200 bg-background px-2 py-1 text-xs font-medium text-ctext dark:border-gray-700"
                            >{{ transaction.account?.name }}</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Amount, time, status -->
        <!-- REMOVED: w-full. ADDED: flex-shrink-0 to prevent numbers from wrapping -->
        <div
            class="flex flex-shrink-0 py-3 pr-3 flex-col items-end justify-between text-right"
        >
            <div class="flex flex-col items-end gap-1">
                <p :class="['font-semibold', amountClass]">
                    {{ formattedAmount }}
                </p>
                <p class="text-sm text-muted">
                    {{ formattedDate }}
                </p>
            </div>

            <div class="mt-4">
                <span
                    :class="[
                        'inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold',
                        getStatusClasses(transaction.status),
                    ]"
                >
                    {{
                        transaction.status === "reviewed"
                            ? "Reviewed"
                            : "To Review"
                    }}
                </span>
            </div>
        </div>
    </article>
</template>
