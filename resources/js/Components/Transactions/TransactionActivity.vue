<script setup>
import { computed } from "vue";
import TransactionGroup from "./TransactionGroup.vue";

const props = defineProps({
    transactions: {
        type: Array,
        required: true,
    },
});

// Group transactions by date (YYYY-MM-DD) — presentational only
const groups = computed(() => {
    const map = new Map();

    props.transactions.forEach((tx) => {
        // prefer ISO date field transaction_date, fall back to date
        const d = tx.transaction_date
            ? new Date(tx.transaction_date)
            : new Date(tx.date);

        if (isNaN(d.getTime())) return;

        // CUT DOWN TO YYYY-MM-DD FOR GROUPING
        const key = d.toISOString().slice(0, 10);

        if (!map.has(key)) {
            map.set(key, []);
        }

        map.get(key).push(tx);
    });

    // CREATE AN ARRAY OF GROUPS SORTED BY DATE DESCENDING
    return Array.from(map.entries())
        .sort((groupA, groupB) => {
            const dateA = groupA[0];
            const dateB = groupB[0];

            if (dateA < dateB) {
                return 1;
            }

            if (dateA > dateB) {
                return -1;
            }

            return 0;
        })
        .map(([dateKey, transactions]) => ({ dateKey, transactions }));
});
</script>

<template>
    <section
        class="rounded-lg border-gray-200 bg-background shadow-sm dark:border-gray-700"
    >
        <div v-if="!groups.length" class="py-8 text-center text-sm text-muted">
            No activity
        </div>

        <div class="space-y-6">
            <TransactionGroup
                v-for="group in groups"
                :key="group.dateKey"
                :dateKey="group.dateKey"
                :transactions="group.transactions"
            />
        </div>
    </section>
</template>
