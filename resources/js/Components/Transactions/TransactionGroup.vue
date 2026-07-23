<script setup>
import TransactionCard from "./TransactionCard.vue";
import { formatLongDate } from "@/Utils/dates";

const props = defineProps({
    dateKey: {
        type: String,
        required: true,
    },
    transactions: {
        type: Array,
        required: true,
    },
});

const heading = formatLongDate(props.dateKey);

const emit = defineEmits(["edit", "delete"]);
</script>

<template>
    <section>
        <h3 class="mb-3 text-sm font-semibold text-muted">{{ heading }}</h3>

        <div class="space-y-3">
            <TransactionCard
                v-for="tx in transactions"
                :key="tx.id"
                :transaction="tx"
                @edit="emit('edit', $event)"
                @delete="emit('delete', $event)"
            />
        </div>
    </section>
</template>
