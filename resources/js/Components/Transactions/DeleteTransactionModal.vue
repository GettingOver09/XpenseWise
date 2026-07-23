<script setup>
import { computed } from "vue";
import Modal from "@/Components/Overlays/Modal.vue";
import { formatMoney } from "@/Utils/currency";
import { formatLongDate } from "@/Utils/dates";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

const props = defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    transaction: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(["close", "confirm"]);

const formattedAmount = computed(() =>
    props.transaction ? formatMoney(props.transaction.amount) : "",
);

const formattedDate = computed(() =>
    props.transaction ? formatLongDate(props.transaction.transaction_date) : "",
);

const confirmDelete = () => {
    if (!props.transaction) return;
    emit("confirm", {
        id: props.transaction.id,
        transaction: props.transaction,
    });
};
</script>

<template>
    <Modal
        :show="show"
        title="Delete Transaction"
        maxWidth="max-w-lg"
        description="This action cannot be undone. Confirm deletion to remove this transaction permanently."
        @close="emit('close')"
    >
        <div class="mt-6 space-y-6">
            <div
                class="rounded-3xl border p-4 text-md text-red-600 border-red-200 font-bold"
            >
                Are you sure you want to delete this transaction?
            </div>

            <div
                class="rounded-3xl border border-gray-200 bg-background p-4 shadow-sm dark:border-gray-700"
            >
                <div class="flex flex-col gap-2">
                    <div class="text-sm font-semibold text-ctext">
                        {{ props.transaction?.payee ?? "Unknown transaction" }}
                    </div>
                    <div class="text-sm text-muted">
                        {{
                            props.transaction?.description ??
                            "No description provided."
                        }}
                    </div>
                    <div
                        class="flex flex-wrap items-center gap-3 text-sm text-muted"
                    >
                        <span>{{
                            props.transaction?.type ?? "Unknown type"
                        }}</span>
                        <span>•</span>
                        <span>{{ formattedDate }}</span>
                        <span>•</span>
                        <span class="font-semibold text-ctext">{{
                            formattedAmount
                        }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-800"
                    @click="emit('close')"
                >
                    Cancel
                </button>
                <PrimaryButton
                    class="bg-red-600 hover:bg-red-700"
                    @click="confirmDelete"
                >
                    Delete Transaction
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
