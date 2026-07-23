<script setup>
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

defineProps({
    show: Boolean,
    title: {
        type: String,
        default: "",
    },
    width: {
        type: String,
        default: "max-w-md",
    },
});

defineEmits(["close"]);
</script>

<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <!-- Backdrop -->
            <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-slate-950/80" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                    >
                        <TransitionChild
                            as="template"
                            enter="transform transition ease-in-out duration-300"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-300"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                :class="['pointer-events-auto w-screen', width]"
                            >
                                <div
                                    class="flex h-full flex-col overflow-y-auto custom-scrollbar border-l border-gray-200 bg-background py-6 shadow-xl dark:border-gray-700"
                                >
                                    <!-- Header -->
                                    <div class="px-4 sm:px-6">
                                        <div
                                            class="flex items-start justify-between"
                                        >
                                            <DialogTitle
                                                class="text-lg font-semibold text-ctext"
                                            >
                                                {{ title }}
                                            </DialogTitle>

                                            <button
                                                class="text-xl text-muted hover:text-ctext"
                                                @click="$emit('close')"
                                            >
                                                ✕
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="mt-6 flex-1 px-4 sm:px-6">
                                        <slot />
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
