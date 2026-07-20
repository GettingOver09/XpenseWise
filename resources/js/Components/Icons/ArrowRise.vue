<script setup>
import { computed } from "vue";

defineOptions({
    name: "ArrowRise",
});

const props = defineProps({
    size: {
        type: [Number, String],
        default: 24,
    },
    color: {
        type: String,
        default: "currentColor",
    },
    title: {
        type: String,
        default: "",
    },
    flipped: {
        type: Boolean,
        default: false,
    },
});

const normalizedSize = computed(() =>
    typeof props.size === "number" ? String(props.size) : props.size,
);

const iconStyle = computed(() => ({
    color: props.color,
    transform: props.flipped ? "rotate(180deg)" : "none",
}));
</script>

<template>
    <svg
        :width="normalizedSize"
        :height="normalizedSize"
        viewBox="0 0 23 23"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        :style="iconStyle"
        :aria-hidden="title ? undefined : true"
        :role="title ? 'img' : undefined"
    >
        <title v-if="title">{{ title }}</title>
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.515 7.91165L20.5 5.5L18.5125 13.9092L16.0332 11.4298L12.0338 15.7694C11.898 15.9167 11.7105 16 11.5144 16C11.3183 16 11.1308 15.9167 10.995 15.7694L8.0584 12.583L3.7394 17.2694C3.46402 17.5682 3.00823 17.5779 2.72138 17.291C2.43452 17.0042 2.42522 16.5294 2.7006 16.2306L7.539 10.9806C7.67477 10.8333 7.86235 10.75 8.0584 10.75C8.25445 10.75 8.44203 10.8333 8.5778 10.9806L11.5144 14.167L14.9944 10.391L12.515 7.91165Z"
            :fill="color"
        />
    </svg>
</template>
