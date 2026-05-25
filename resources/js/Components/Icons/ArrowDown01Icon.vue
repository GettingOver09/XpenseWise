<script setup>
import { computed } from 'vue';

defineOptions({
    name: 'ArrowDown01Icon',
});

const props = defineProps({
    size: {
        type: [Number, String],
        default: 24,
    },
    color: {
        type: String,
        default: 'currentColor',
    },
    title: {
        type: String,
        default: '',
    },
});

const normalizedSize = computed(() => (
    typeof props.size === 'number' ? String(props.size) : props.size
));

const iconStyle = computed(() => ({
    color: props.color,
}));
</script>

<template>
    <svg
        :width="normalizedSize"
        :height="normalizedSize"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        :style="iconStyle"
        :aria-hidden="title ? undefined : true"
        :role="title ? 'img' : undefined"
    >
        <title v-if="title">{{ title }}</title>
        <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</template>
