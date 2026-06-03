<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block text-sm font-medium text-ctext mb-1">
        {{ value }}
    </label>
</template>