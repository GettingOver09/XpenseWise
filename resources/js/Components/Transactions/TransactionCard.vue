<script setup>
import { computed } from "vue";
import { formatMoney } from "@/Utils/currency";

const props = defineProps({
    transaction: {
        type: Object,
        required: true,
    },
});

const amountClass = computed(() => {
    if (props.transaction.type === "income") {
        return "text-emerald-600 dark:text-emerald-400";
    }
    if (props.transaction.type === "transfer") {
        return "text-slate-600 dark:text-slate-300";
    }
    return "text-rose-600 dark:text-rose-400";
});

const formattedAmount = computed(() => formatMoney(props.transaction.amount));

const formattedTime = computed(() => {
    if (!props.transaction.transaction_date) return "";
    const d = new Date(props.transaction.transaction_date);
    return d.toLocaleTimeString([], { hour: "numeric", minute: "2-digit" });
});

const capitalizedType = computed(() => {
    if (!props.transaction.type) return "";
    return (
        props.transaction.type.charAt(0).toUpperCase() +
        props.transaction.type.slice(1)
    );
});
</script>

<template>
    <article
        class="flex gap-4 rounded-lg border border-gray-200 bg-background p-4 dark:border-gray-700"
    >
        <!-- Left: Icon (placeholder) -->
        <div
            class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-gray-100 text-lg dark:bg-gray-800"
        >
            <span aria-hidden>🍔</span>
        </div>

        <!-- Middle: Info -->
        <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <p class="truncate font-semibold text-ctext">
                        {{ transaction.merchant }}
                        <span class="text-muted">•</span>
                        <span class="text-sm text-muted">{{
                            capitalizedType
                        }}</span>
                    </p>
                    <p class="mt-1 truncate text-sm text-muted">
                        {{ transaction.description }}
                    </p>

                    <div class="mt-2 flex flex-wrap gap-2">
                        <span
                            v-if="transaction.category"
                            class="rounded-full border border-gray-200 bg-background px-2 py-1 text-xs font-medium text-ctext dark:border-gray-700"
                            >{{ transaction.category }}</span
                        >
                        <span
                            v-if="transaction.subcategory"
                            class="rounded-full border border-gray-200 bg-background px-2 py-1 text-xs font-medium text-ctext dark:border-gray-700"
                            >{{ transaction.subcategory }}</span
                        >
                        <span
                            v-if="transaction.account"
                            class="rounded-full border border-gray-200 bg-background px-2 py-1 text-xs font-medium text-ctext dark:border-gray-700"
                            >{{ transaction.account }}</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Amount, time, status -->
        <div
            class="flex w-40 flex-shrink-0 flex-col items-end justify-between text-right"
        >
            <div class="">
                <p :class="['font-semibold', amountClass]">
                    {{ formattedAmount }}
                </p>
                <p class="mt-1 text-sm text-muted">{{ formattedTime }}</p>
            </div>

            <div class="mt-4">
                <span
                    class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-muted dark:bg-gray-800"
                    >{{ transaction.status }}</span
                >
            </div>
        </div>
    </article>
</template>
