<script setup>
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { reactive, watch } from "vue";
import Drawer from "@/Components/Overlays/Drawer.vue";

import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import InputError from "@/Components/Forms/InputError.vue";

const props = defineProps({
    show: Boolean,
    transaction: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(["close", "save"]);

const form = reactive({
    payee: "",
    amount: "",
    description: "",
    transaction_date: "",
    type: "",
    status: "",
    account_id: null,
    category_id: null,
});

watch(
    () => props.transaction,
    (transaction) => {
        if (!transaction) return;

        form.payee = transaction.payee ?? "";
        form.amount = transaction.amount ?? "";
        form.description = transaction.description ?? "";
        form.transaction_date =
            transaction.transaction_date?.slice(0, 10) ?? "";

        form.type = transaction.type ?? "";
        form.status = transaction.status ?? "";

        form.account_id = transaction.account?.id ?? null;
        form.category_id = transaction.category?.id ?? null;
    },
    {
        immediate: true,
    },
);

const save = () => {
    emit("save", {
        id: props.transaction.id,

        payee: form.payee,
        amount: form.amount,
        description: form.description,
        transaction_date: form.transaction_date,

        type: form.type,
        status: form.status,

        account_id: form.account_id,
        category_id: form.category_id,
    });
};
</script>

<template>
    <Drawer :show="show" title="Edit Transaction" @close="$emit('close')">
        <div class="space-y-5">
            <div>
                <InputLabel for="payee" value="Payee" />

                <TextInput
                    id="payee"
                    v-model="form.payee"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="number"
                    v-model="form.amount"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="transaction_date" value="Date" />

                <TextInput
                    id="transaction_date"
                    type="date"
                    v-model="form.transaction_date"
                    class="mt-1 block w-full"
                />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="pt-4">
                <PrimaryButton @click="save"> Save Changes </PrimaryButton>
            </div>
        </div>
    </Drawer>
</template>
