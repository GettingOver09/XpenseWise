<script setup>
import { computed } from 'vue';

defineOptions({
    name: 'Notification02Icon',
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
        <path d="M19 18V9.5C19 5.63401 15.866 2.5 12 2.5C8.13401 2.5 5 5.63401 5 9.5V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M20.5 18H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M13.5 20C13.5 20.8284 12.8284 21.5 12 21.5M12 21.5C11.1716 21.5 10.5 20.8284 10.5 20M12 21.5V20" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
    </svg>
</template>
