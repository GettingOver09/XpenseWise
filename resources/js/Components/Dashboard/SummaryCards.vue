<script setup>
defineProps({
    cards: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <section
            v-for="card in cards"
            :key="card.label"
            class="rounded-lg border border-gray-200 bg-background p-5 shadow-sm dark:border-gray-700"
        >
            <p class="text-sm font-medium text-muted">
                {{ card.label }}
            </p>

            <p
                class="mt-3 text-3xl font-bold"
                :class="card.tone"
            >
                {{ card.value }}
            </p>

            <p class="mt-2 text-sm text-muted">
                {{ card.helper }}
            </p>
        </section>
    </div>
</template>