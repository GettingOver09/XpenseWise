<script setup>
import { computed } from 'vue';

defineOptions({
    name: 'CircleArrowLeft02Icon',
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
        <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M9.00014 12.0001H16.0001M11.4999 8.5C11.4999 8.5 8 11.0777 8 12C7.99999 12.9224 11.4999 15.5 11.4999 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</template>
