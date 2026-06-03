<script setup>
defineProps({
    modelValue: String,
    type: {
        type: String,
        default: 'text',
    }
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <input
        v-bind="$attrs"  
        :value="modelValue"
        :type="type"
        @input="emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-background px-3 py-2 text-sm text-ctext focus:ring-2 focus:ring-primary focus:outline-none transition"
    />
</template>