<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button
        v-bind="$attrs"
        :disabled="disabled"
        class="inline-flex items-center justify-center rounded-lg
               bg-primary px-5 py-2.5 text-sm font-medium text-white
               transition hover:bg-primary/90
               disabled:cursor-not-allowed disabled:opacity-50"
    >
        <slot />
    </button>
</template>