<script setup>
import {
    Tab,
    TabGroup,
    TabList,
} from '@headlessui/vue';

const selectedIndex = defineModel('selectedIndex');

defineProps({
    types: {
        type: Array,
        required: true,
    },
});
</script>

<template>
     <TabGroup
            :selected-index="selectedIndex"
            class="w-full xl:max-w-sm"
            @change="selectedIndex = $event"
        >
            <TabList class="flex space-x-1 rounded-xl bg-gray-100 p-1 dark:bg-gray-800">
                <Tab
                    v-for="type in types"
                    :key="type"
                    v-slot="{ selected }"
                    as="template"
                >
                    <button
                        :class="[
                            'w-full rounded-lg px-3 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-gray-900',
                            selected
                                ? 'bg-background text-primary shadow-sm'
                                : 'text-muted hover:bg-white/60 hover:text-ctext dark:hover:bg-gray-700',
                        ]"
                    >
                        {{ type }}
                    </button>
                </Tab>
            </TabList>
        </TabGroup>

</template>