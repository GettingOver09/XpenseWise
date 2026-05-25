<script setup>
import { computed } from 'vue';

defineOptions({
    name: 'AddSquareIcon',
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
        <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89125C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89125C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7176 20.1088 20.1088C18.7175 21.5001 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5001 3.89124 20.1088C2.5 18.7176 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 8V16M16 12.0001H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</template>
